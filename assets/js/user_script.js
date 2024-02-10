jQuery(document).ready(function ($) {
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

  // Make images lazy load
  // $('img[data-src]').each(function () {
  //   $(this).attr('src', $(this).data('src'));
  // });
  // $('iframe[data-src]').each(function () {
  //   $(this).attr('src', $(this).data('src'));
  // });


  // Add headings in TOC in single blog page
  let headingH1 = $('.blog-content h1, .blog-content h2');

  // Find child elements
  $(headingH1).each(function (index, heading) {
    let text = $(heading).text();
    let id = text.replace(/\s+/g, '_');
    $(heading).attr('id', id);

    $('.toc').append(`<li class="list-unstyled lh-lg mb-1"><a href="#${id}" class="text-dark fw-light text-decoration-none text-capitalize">${text}</a></li>`);

    // Find child elements
    let subHeadingContainer = $('<ul class="list-unstyled p-0 ms-4"></ul>');

    $(heading).nextUntil('h1,h2').filter(':header').each(function (index, subHeading) {
      let subHeadingText = $(subHeading).text();
      let subHeadingId = subHeadingText.replace(/\s+/g, '_');
      $(subHeading).attr('id', subHeadingId);

      subHeadingContainer.append(`<li class="lh-lg mb-1"><a href="#${subHeadingId}" class="text-dark fw-light text-decoration-none text-capitalize">${subHeadingText}</a></li>`);
    });

    $('.toc').append(subHeadingContainer);
  });




  // Copy page URL on copy button click on single blog page
  $('.blog-social-share-copy').click((e) => {
    navigator.clipboard.writeText(decodeURI(window.location.href.toLowerCase()))
      .then(() => {
        $(e.target).html('<i class="bi bi-check2 d-inline-block fs-5"></i>')

        setTimeout(() => {
          $(e.target).html('<i class="bi bi-copy d-inline-block fs-5"></i>')
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

        console.log(res)
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



  // // Add post like dislike functionality
  // $('.user-post-disliked').click((e) => changePostLikeStatus($(e.target).attr('data-liked'), $(e.target).attr('data-post')))
  // $('.user-post-liked').click((e) => changePostLikeStatus($(e.target).attr('data-liked'), $(e.target).attr('data-post')));

  // Retrieve the value of the 'likedPosts' cookie using native JavaScript
  // var likedPostsCookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)userLikedPosts\s*=\s*([^;]*).*$)|^.*$/, '$1');

  // Parse the JSON string to get the array
  // var likedPostsArray = likedPostsCookieValue ? JSON.parse(likedPostsCookieValue) : [];

  // Now 'likedPostsArray' contains your liked posts
  // console.log(likedPostsArray);


  // function changePostLikeStatus(status, post) {
  //   let postIndex = $.inArray(post, likedPostsArray);
  //   if (postIndex === -1) {
  //     // Post ID does not exist in the array
  //     likedPostsArray.push(post);

  //     // Calculate expiration date for one week (in seconds)
  //     let expirationDate = new Date();
  //     expirationDate.setTime(expirationDate.getTime() + (7 * 24 * 60 * 60 * 1000));

  //     // Store likedPosts in the cookie as a JSON string
  //     document.cookie = `userLikedPosts=${JSON.stringify(likedPostsArray)}; expires=${expirationDate.toUTCString()}; path=/`;
  //   }
  // }

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
  function triggerEmailPopup() {
    $('.email-popup-wrapper').addClass('d-flex').removeClass('d-none').addClass('align-items-center')
    $('body').addClass('overflow-hidden')
    lazyLoadImages()
  }

  $('.email-popup-close, .email-popup-overlay').click(() => {
    $('.email-popup-wrapper').removeClass('d-flex').addClass('d-none').removeClass('align-items-center')
    $('body').removeClass('overflow-hidden')
    lazyLoadImages()
    popupClosedOnce = true;
  })

  var popupClosedOnce = false;

  $(document).scroll(function () {
    // console.log(window.scrollY, document.body.scrollHeight, window.innerHeight)
    var scrollPosition = window.scrollY;
    var totalHeight = document.body.scrollHeight - window.innerHeight;
    var scrollPercentage = parseInt(((scrollPosition / totalHeight) * 100).toFixed(2));

    if (scrollPercentage >= parseInt(admin_ajax.page_scroll_limit) && !popupClosedOnce) {
      triggerEmailPopup();
    }
  })

  setTimeout(() => {
    if (!popupClosedOnce) {
      triggerEmailPopup()
    }
  }, parseInt(admin_ajax.email_popup_timer));

  // Convert h1 to h2 headings in blog content
  $('.blog-content h1').each(function () {
    var newElement = $('<h2>');
    newElement.html($(this).html());
    $(this).replaceWith(newElement);
  })

});


