<?php
  namespace UI;

  class SectionAnnouncement {
    public function render() {
      ?>

    <!-- event banner: uncomment this section when we have an event or promotion -->
    <div class="section section-announcement">
      <div class='wrapper'>
        <div class='content'>
            <p style='font-size:2em'><a href='/funding-appeal'>Funding appeal &mdash; we need your support</a></p>
            <p style='font-size:1.25em; color: black; line-height: 1.25em; font-weight: normal'>
                The Keyman project is facing a major funding crisis. <a href="/funding-appeal">Learn more</a>
            </p>
        </div>
      </div>
    </div>

      <?php
    }
  }
