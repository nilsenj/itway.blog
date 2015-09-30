// JavaScript source code
$(document).ready(function () {

    $('.tooltip-bottom').tooltipster
    ({
        animation: 'fade',
        delay: 200,
        theme: 'tooltipster-light',
        touchDevices: true,
        trigger: 'hover',
        position: "bottom"
    });

    $('.tooltip-left').tooltipster
    ({
        animation: 'fade',
        delay: 200,
        theme: 'tooltipster-light',
        touchDevices: true,
        trigger: 'hover',
        position: "left"
    });
    $('.tooltip-right').tooltipster
  ({
      animation: 'fade',
      delay: 200,
      theme: 'tooltipster-light',
      touchDevices: true,
      trigger: 'hover',
      position: "right"
  });


    $('.tooltip').tooltipster({

        animation: 'fade',
        delay: 200,
        theme: 'tooltipster-light',
        touchDevices: true,
        trigger: 'hover'

    });
});
