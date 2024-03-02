jQuery(document).ready(function ($) {


  // Add classes to body element based on user source
  /** Check the source of user */
  let user_source = sessionStorage.getItem('user_referrer_domain');
  let website_hostname = window.location.hostname;
  let url_obj = window.location;
  let referrer = document.referrer;

  if (user_source === null) {
    if (referrer && referrer !== '') {
      let url_obj = new URL(referrer);
      user_source = url_obj.hostname.toLowerCase();
    } else {
      user_source = 'direct'; // Set a default value for direct traffic
    }
    sessionStorage.setItem('user_referrer_domain', user_source);
  }

  if (user_source !== website_hostname) {
    if (user_source === 'google.com' || user_source === 'google.co.uk') {
      $('body').addClass('traffic_source_google');
    } else if (user_source === 'raterhub.com') {
      $('body').addClass('traffic_source_google');
    } else if (user_source === 'news.google.com') {
      $('body').addClass('traffic_source_google');
    } else if (user_source === 'discover.google.com') {
      $('body').addClass('traffic_source_google');
    } else {
      $('body').addClass('from_' + user_source.replace(/\./g, '_')); // Adjust class naming
    }

  } else {
    $('body').addClass('ayl_inbuilt_traffic');
  }

  // Animate header search form width
  $('header .animate-search-form').click(function () {
    var formInput = $('header form input[type="search"]');
    var currentLeft = formInput.css('left');

    if (currentLeft === '0px') {
      // If the current left is 0px, animate it to 100%
      formInput.animate({ left: '100%' }, 300, function () {
        // After animation, focus the input field
        formInput.blur();
      });
    } else {
      // If the current left is 100%, animate it to 0px
      formInput.animate({ left: 0 }, 300, function () {
        formInput.focus()
      });
    }
  });


  $('.popular_brands_slider').slick({
    infinite: false,
    slidesToShow: 7,
    slidesToScroll: 1,
    prevArrow: '<button type="button" class="slick-prev p-0 position-absolute top-50 translate-middle-y start-0 border-0 text-primary w-auto"><i class="bi bi-chevron-left"></i></button>',
    nextArrow: '<button type="button" class="slick-next p-0 position-absolute top-50 translate-middle-y end-0 border-0 text-primary w-auto"><i class="bi bi-chevron-right"></i></button>',
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }
    ]
  })

  // Convert h1 to h2 headings in blog content
  $('.blog-content h1').each(function () {
    var newElement = $('<h2>');
    newElement.html($(this).html());
    $(this).replaceWith(newElement);
  })

  // Add headings in TOC in single blog page
  let headingH1 = $('.blog-content h1, .blog-content h2');

  // Find child elements
  $(headingH1).each(function (index, heading) {
    let text = $(heading).text();
    let id = text.replace(/\s+/g, '_');
    $(heading).attr('id', id);

    $('.toc').append(`<li class="list-unstyled lh-lg mb-1"><a href="#${id}" class="text-dark fw-normal text-decoration-none text-capitalize">${text}</a></li>`);

    // Find child elements
    let subHeadingContainer = $('<ul class="list-unstyled p-0 ms-4"></ul>');

    $(heading).nextUntil('h1,h2').filter(':header').each(function (index, subHeading) {
      let subHeadingText = $(subHeading).text();
      let subHeadingId = subHeadingText.replace(/\s+/g, '_');
      $(subHeading).attr('id', subHeadingId);

      subHeadingContainer.append(`<li class="lh-lg mb-1"><a href="#${subHeadingId}" class="text-dark fw-normal text-decoration-none text-capitalize">${subHeadingText}</a></li>`);
    });

    $('.toc').append(subHeadingContainer);
  });

  $('.toggle-toc-mobile').click((e) => {
    const tocWrapper = $('.toc-mobile-wrapper');
    tocWrapper.animate({
      height: 'toggle',
      overflow: 'toggle'
    }, function () {
      const isExpanded = tocWrapper.is(':visible');
      $('.toggle-toc-mobile-text').text(isExpanded ? 'Show less' : 'Show more');
    });
  });



  // Copy page URL on copy button click on single blog page
  $('.blog-social-share-copy').click(function () {
    navigator.clipboard.writeText(decodeURI(window.location.href.toLowerCase()))
      .then(() => {
        $(this).html('<i class="bi bi-check2 d-inline-block fs-5"></i>')

        setTimeout(() => {
          $(this).html('<i class="bi bi-copy d-inline-block fs-5"></i>')
        }, 4000);
      })
      .catch((err) => {
        alert('Unable to copy text to clipboard ' + err)
      });
  })

  // Add post in recently viewed cookie
  var loadSidebarContentList = true;
  var loadSidebarContentGrid = true;

  $('.blog-sidebar-toggle').click((e) => {
    let target = $(e.target).attr('data-target');
    $(e.target).closest('article')
      .find('.blog-sidebar-tab')
      .addClass('d-none');

    $(e.target).closest('article')
      .find('.blog-sidebar-toggle')
      .removeClass('bg-primary text-light')
      .addClass('bg-secondary')

    $(e.target)
      .addClass('bg-primary text-light')
      .removeClass('bg-secondary')

    $(target).removeClass('d-none')

    // If user clicked on list view toggle buttons
    if
      ((target === '#recently-viewed-tab-list' || target === '#liked-blogs-tab-list')
      && loadSidebarContentList) {
      loadSideBarCards('list', $(e.target).attr('data-target'))
    } else if
      ((target === '#recently-viewed-tab' || target === '#liked-blogs-tab')
      && loadSidebarContentGrid) {
      loadSideBarCards('grid', $(e.target).attr('data-target'))
    }

  })

  // Load sidebar content in blog page
  function loadSideBarCards(layout, trigger) {
    $.ajax({
      type: 'POST',
      url: admin_ajax.ajax_url,
      data: {
        contentLayout: layout,
        action: 'automate_life_recent_and_liked_posts',
      },
      success: function (response) {
        let res = JSON.parse(response);

        if (trigger === '#recently-viewed-tab-list' ||
          trigger === '#liked-blogs-tab-list') {
          $('#liked-blogs-tab-list').html(res.liked_posts)
          $('#recently-viewed-tab-list').html(res.recently_viewed);
          loadSidebarContentList = false;
        } else if (trigger === '#recently-viewed-tab' ||
          trigger === '#liked-blogs-tab') {
          loadSidebarContentGrid = false;
          $('#liked-blogs-tab').html(res.liked_posts);
          $('#recently-viewed-tab').html(res.recently_viewed);
        }

        lazyLoadImages()
      },
      error: function (XHR, error, status) {
        alert(status)
      }
    })
  }

  // Function to toggle back to top button visibility
  function toggleBackToTopVisibility() {
    const scrollThreshold = 300;
    const $backToTopButton = $('.scroll-back-to-top');

    if (window.scrollY >= scrollThreshold) {
      $backToTopButton.fadeIn();
    } else {
      $backToTopButton.fadeOut();
    }
  }

  // Initial call to set button visibility on page load
  toggleBackToTopVisibility();

  // Call the function when the user scrolls
  $(window).scroll(toggleBackToTopVisibility);

  // Scroll back to top on button click
  $('.scroll-back-to-top').click(() => {
    window.scrollTo(0, 0);
  });
  // Function to check if an element is in the viewport
  function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    // return (
    //   rect.top >= 0 &&
    //   rect.left >= 0 &&
    //   rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    //   rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    // );
    return (
      (rect.top <= window.innerHeight && rect.bottom >= 0) ||
      (rect.bottom >= 0 && rect.top <= 100)
    );
  }

  // Function to lazy load images
  function lazyLoadImages() {
    // Select all images and iframes with data-src attribute
    $('img[data-src], iframe[data-src]').each(function () {
      if (isElementInViewport(this)) {
        // If the element is in the viewport, copy data-src to src
        $(this).attr('src', $(this).data('src'));
        // Remove the data-src attribute to avoid unnecessary processing in the future
        $(this).removeAttr('data-src');
      }
    });
  }

  lazyLoadImages();

  // Load images on scroll
  $(document).scroll(function () {
    lazyLoadImages();
  });
  // Load images on slick slider navigation
  $('.slick-arrow').click(function () {
    lazyLoadImages();
  })


  // Social Share Button
  $('.blog-social-share-share').click(function () {
    let $page_url = window.location.href.trim().toLowerCase()
    let optionsArr = [
      {
        'name': 'facebook',
        'icon': 'bi-facebook',
        'url': `https://www.facebook.com/sharer/sharer.php?u='${$page_url}`
      }
    ]
    let popupHTML = `<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Title</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal Body -->
        <div class="modal-body">
        ${optionsArr.map(option => `
  <div>${option}</div>
`).join('')}
        </div>
  
        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save Changes</button>
        </div>
  
      </div>
    </div>
  </div>`;

    $('body').append(popupHTML)
    $('#myModal').addClass('show open')

  })


  /**************** common functions for like and dislike ********************/
  function sendpostlikedislikedstatus(currentpostid, likeddisliked, decrement_flag) {
    var currentpostid = currentpostid;
    var post_status = likeddisliked;
    var decrement_flag = decrement_flag;

    // Perform the AJAX request
    $.ajax({
      type: 'POST',
      url: admin_ajax.ajax_url,
      data: {
        action: 'post_liked_disliked',
        post_id: currentpostid,
        current_status: post_status,
        decrement_flag: decrement_flag
      },
      success: function (response) {
        console.log(response);
      },
      error: function (error) {
        console.error('AJAX Error:', error);
      }
    });

  }

  function getLikedDislikedPostsFromCookie(cookie_name) {
    var likeddislikedPosts = [];
    var cookieValue = document.cookie.replace(new RegExp("(?:(?:^|.*;\\s*)" + cookie_name + "\\s*=\\s*([^;]*).*$)|^.*$"), "$1");

    if (cookieValue) {
      likeddislikedPosts = JSON.parse(cookieValue);
    }
    return likeddislikedPosts;
  }


  function saveLikedDislikedPostsToCookie(likeddislikedPosts, cookie_name) {
    var cookieValue = JSON.stringify(likeddislikedPosts);
    var expirationDate = new Date(new Date().getTime() + 365 * 24 * 60 * 60 * 1000 * 10);
    document.cookie = cookie_name + '=' + cookieValue + '; expires=' + expirationDate.toUTCString() + '; path=/';
  }

  /**************liked posts******************/


  $(document).on('click', '.user-post-liked', function (e) {
    // Get the current post ID
    var decrement_flag = 0;
    var currentpostid = $(this).data('post');

    if ($('.user-post-liked > img').hasClass('custom-text-info')) {
      $('.user-post-liked > img').removeClass('custom-text-info');
      var likedPosts = getLikedDislikedPostsFromCookie('liked_posts');
      likedPosts = likedPosts.filter(function (id) {
        return id !== currentpostid;
      });
      saveLikedDislikedPostsToCookie(likedPosts, 'liked_posts');

      sendpostlikedislikedstatus(currentpostid, 'remove_liked', decrement_flag);

    } else {
      if ($('.user-post-disliked > img').hasClass('custom-text-danger')) {
        $('.user-post-disliked > img').removeClass('custom-text-danger');

        var dislikedPosts = getLikedDislikedPostsFromCookie('disliked_posts');
        dislikedPosts = dislikedPosts.filter(function (id) {
          return id !== currentpostid;
        });
        saveLikedDislikedPostsToCookie(dislikedPosts, 'disliked_posts');
        decrement_flag = 1;

      }
      $('.user-post-liked > img').addClass('custom-text-info');
      var likedPosts = getLikedDislikedPostsFromCookie('liked_posts');
      likedPosts.push(currentpostid);
      saveLikedDislikedPostsToCookie(likedPosts, 'liked_posts');
      sendpostlikedislikedstatus(currentpostid, 'liked', decrement_flag);
    }
  });


  /***************************disliked posts**************/

  $(document).on('click', '.user-post-disliked', function (e) {
    // Get the current post ID
    var decrement_flag = 0;
    var currentpostid = $(this).data('post');

    if ($('.user-post-disliked > img').hasClass('custom-text-danger')) {
      $('.user-post-disliked > img').removeClass('custom-text-danger');

      var dislikedPosts = getLikedDislikedPostsFromCookie('disliked_posts');
      dislikedPosts = dislikedPosts.filter(function (id) {
        return id !== currentpostid;
      });
      saveLikedDislikedPostsToCookie(dislikedPosts, 'disliked_posts');
      sendpostlikedislikedstatus(currentpostid, 'remove_disliked', decrement_flag);

    } else {

      if ($('.user-post-liked > img').hasClass('custom-text-info')) {
        $('.user-post-liked > img').removeClass('custom-text-info');

        var likedPosts = getLikedDislikedPostsFromCookie('liked_posts');
        likedPosts = likedPosts.filter(function (id) {
          return id !== currentpostid;
        });
        saveLikedDislikedPostsToCookie(likedPosts, 'liked_posts');
        decrement_flag = 1;

      }

      $('.user-post-disliked > img').addClass('custom-text-danger');
      var dislikedPosts = getLikedDislikedPostsFromCookie('disliked_posts');
      dislikedPosts.push(currentpostid);
      saveLikedDislikedPostsToCookie(dislikedPosts, 'disliked_posts');
      sendpostlikedislikedstatus(currentpostid, 'disliked', decrement_flag);
    }
  });



  /***************show modal after 15 seconds****************/
  var popupSession = JSON.parse(sessionStorage.getItem('popupSessionActive')) || false;
  let isSubscriber = admin_ajax.is_subscriber;

  function triggerEmailPopup() {
    $('.email-popup-wrapper').addClass('d-flex').removeClass('d-none').addClass('align-items-center');
    $('body').addClass('overflow-hidden');
    lazyLoadImages();
    sessionStorage.setItem('popupSessionActive', JSON.stringify(true)); // popup session is activated
    popupSession = true;
  }

  // Show popup if the user hasn't seen it and it's been 15 seconds
  setTimeout(() => {
    if (!popupSession && isSubscriber !== 'true') {
      triggerEmailPopup();
    }
  }, parseInt(admin_ajax.email_popup_timer));

  $(document).scroll(function () {
    var scrollPosition = window.scrollY;
    var totalHeight = document.body.scrollHeight - window.innerHeight;
    var scrollPercentage = parseInt(((scrollPosition / totalHeight) * 100).toFixed(2));

    // Show popup if the user hasn't seen it and has scrolled 50% of the page
    if (scrollPercentage >= parseInt(admin_ajax.page_scroll_limit) && !popupSession
      && isSubscriber !== 'true') {
      triggerEmailPopup();
    }
  })


  $('.email-popup-close, .email-popup-overlay, .email-popup-close i').click((e) => {
    $('.email-popup-wrapper').removeClass('d-flex').addClass('d-none').removeClass('align-items-center');
    $('body').removeClass('overflow-hidden');
    lazyLoadImages();
  })

  // Animate keypoints design in single blog page
  if ($('body').hasClass('single-post')) {
    $(window).scroll(() => {
      $('.keypoints-list-wrap').each(function () {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        if (elementBottom > viewportTop && elementTop < viewportBottom) {
          var $lis = $(this).find('li');
          var $lis = $(this).find('li');
          $lis.each(function (index) {
            var $li = $(this);
            setTimeout(function () {
              $li.addClass('animation-active');
            }, index * 1000); // Delay in milliseconds (1 second)
          });
        } else {
          // var $lis = $(this).find('li');
          // var $lis = $(this).find('li');
          // $lis.each(function (index) {
          //   var $li = $(this);
          //   setTimeout(function () {
          //     $li.removeClass('animation-active');
          //   }, index * 1000); // Delay in milliseconds (1 second)
          // });
        }
      });
    })
  }

  // Handle lead form submissions
  $('.lead-form').submit(function (e) {
    e.preventDefault();
    let userEmail = $(this).find('[type="email"]').val().trim()
    let $form = $(this)
    let preventFormSubmission = $(this).find('.lead-form-prevent-submission').val().trim();

    $form.find('input[type="submit"]').val('Loading...')

    if (preventFormSubmission === '') {
      // Submit the form
      if (userEmail !== '') {
        $form.find('input[type="email"]').removeAttr('disabled', true)
        $.ajax({
          type: 'POST',
          url: admin_ajax.ajax_url,
          data: {
            email: userEmail,
            action: 'automatelife_handle_form_submission',
          },
          success: function (response) {
            console.log(response)
            let successResponse = `<div class="lead-form-success-response alert alert-success m-0 position-absolute w-100 top-0 start-0 h-100 d-flex align-items-center justify-content-center  ">
            <p class="m-0 font-20">${response.data}</p>
            </div>`;
            let errorResponse = `<div class="lead-form-danger-response alert alert-danger m-0 position-absolute w-100 top-0 start-0 h-100 d-flex align-items-center justify-content-center  ">
            <p class="m-0 font-20">${response.data}</p>
            </div>`;
            
            if (response.success) {
              $form.append(successResponse)
              $form.find('input[type="submit"]').val('subscribe')
              // Add cookies to track that user is subscribed
              let expirationDate = new Date();
              expirationDate.setFullYear(expirationDate.getFullYear() + 10); // Set expiration to 10 years from now

              // Convert the expiration date to UTC string format
              let expiresUTCString = expirationDate.toUTCString();

              document.cookie = "user_is_subscribed=true; expires=" + expiresUTCString + "; path=/; ";

              /** If user is at single blog page then after successfull form submission reload the page to show the
               * full blog content
               */
              if ($('body').hasClass('single-post')) {
                window.location.reload()
              }
            } else {
              $form.append(errorResponse)
              $form.find('input[type="submit"]').val('subscribe')

              setTimeout(() => {
                $form.find('.lead-form-danger-response').remove()
              }, 4000);              
            }
          },
          error: function (XHR, error, status) {
            alert('Something went wrong' + ' ' + error + ' ' + status)
            $form.find('input[type="submit"]').val('subscribe')
          }
        })
      }
    } else {
      $form.find('input[type="email"]').attr('disabled', true)
    }

  })

  // Send feedback sidebar trigger
  $('.send-feedback-trigger').click(function () {
    $(document).find('.send-feedback-wrapper').addClass('active')
    $(document).find('.send-feedback-overlay').addClass('active')
    $(document).find('.send-feedback-sidebar').addClass('active')
    $('body').addClass('overflow-hidden')
  })

  $('.send-feedback-overlay, .send-feedback-close').click(function () {
    $(this).removeClass('active')
    $('.send-feedback-sidebar').removeClass('active')
    setTimeout(() => {
      $(document).find('.send-feedback-wrapper').removeClass('active')
    }, 600);
    $('body').removeClass('overflow-hidden')
  })

  $('.send-feedback-form').submit(function (e) {
    e.preventDefault();
    let feedbackResponse = $('#send-feedback-textarea').val()
    let postName = $('#send-feedback-postname').val()
    let honeypotField = $('#send-feedback-form-prevent-submission').val().trim()
    let $form = $(this)

    // Show the spinner indicating the form submission
    $('.send-feedback-spinner').removeClass('d-none')

    if (honeypotField === '') {
      // Submit the form
      if (feedbackResponse !== '') {
        $form.find('input[type="email"]').removeAttr('disabled', true)
        feedbackResponse = feedbackResponse.trim();

        $.ajax({
          type: 'POST',
          url: admin_ajax.ajax_url,
          data: {
            feedbackResponse: feedbackResponse,
            postName: postName,
            action: 'submit_user_feedback',
          },
          success: function (response) {

            if (response.success) {
              $('.feedback-response-text').addClass('border-success').removeClass('border-danger').removeClass('text-danger').addClass('text-success')
            } else {
              $('.feedback-response-text').removeClass('border-success').addClass('border-danger').addClass('text-danger').removeClass('text-success')
            }

            $('.feedback-response-text').removeClass('d-none')
            $('.feedback-response-text').text(response.data)
            $('.send-feedback-spinner').addClass('d-none')
            $('#send-feedback-textarea').val('')
          },
          error: function (XHR, status, error) {
            alert(status)
            $('.send-feedback-spinner').addClass('d-none')
            $('#send-feedback-textarea').val('')
          }
        })
      }
    } else {
      // Do not submit the form
      $form.find('input[type="email"]').attr('disabled', true)
      $('.send-feedback-spinner').addClass('d-none')
      $('#send-feedback-textarea').val('')
      $('.feedback-response-text').removeClass('border-success')
        .addClass('border-danger')
        .addClass('text-danger')
        .addClass('d-none')
        .removeClass('text-success').text('Something went wrong please try again')
    }


  })


  // Add active class to TOC list element that is currently in viewport
  $(window).scroll(function () {
    let scrollTop = $(document).scrollTop();
    let windowHeight = $(window).height();
    let halfViewportHeight = windowHeight / 2;

    $('.table-of-content-column .toc li a').removeClass('active');

    $('.blog-content h2, .blog-content h3').each(function (index, heading) {
      let headingId = $(heading).attr('id');
      if (!headingId) {
        return; // Move to the next heading
      }

      // Get the position of the heading relative to the document
      let headingOffsetTop = $(heading).offset().top;

      // Check if the heading is within the first half of the viewport
      if (headingOffsetTop >= scrollTop && headingOffsetTop <= scrollTop + halfViewportHeight) {
        // Add active class to the corresponding TOC link
        $('.table-of-content-column .toc li a[href="#' + headingId + '"]').addClass('active');
        return false; // Break the loop once the first matching heading is found
      }
    });
  });


  // Make smart products in stock a slider in mobile
  function initSlickSlider() {
    $('.smart-products-slick-mobile').slick({
      // Slick slider options
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: true,
      arrows: false,
    });
  }

  function checkWindowWidth() {
    var windowWidth = $(window).width();
    if (windowWidth <= 768) { // Adjust the breakpoint as needed
      initSlickSlider();
    } else {
      $('.smart-products-slick-mobile').slick('unslick');
    }
  }

  checkWindowWidth();
  $(window).resize(checkWindowWidth);


});