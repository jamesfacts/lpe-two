<div class="">
    <span class="font-necto uppercase">share</span>
    <ul class="mt-3 flex flex-wrap">
        <li>
            <a class="generic-button mr-2 mb-2" href="mailto:?subject={!! the_title() !!}body={!! $shareUrl !!}" target="_self"
                rel="noopener" aria-label="Share by E-Mail">
                <span class="">
                    Email 
                </span>
            </a>
        </li>
        <li>
            <a class="generic-button mr-2 mb-2" href="https://facebook.com/sharer/sharer.php?u={!! $shareUrl !!}" target="_blank"
                rel="noopener" aria-label="Share on Facebook">
                <span class="">
                    Facebook 
                </span>
            </a>
        </li>
        <li>
            <a class="generic-button mr-2 mb-2" href="https://twitter.com/intent/tweet/?text={!! $shareTitle !!}&amp;url={!! $shareUrl !!}"
                target="_blank" rel="noopener" aria-label="Share on Twitter" data-via="LPEblog" data-related="LPEblog">
                <span class="">
                    Twitter 
                </span>
            </a>
        </li>
        <li>
            <a class="generic-button mr-2 mb-2" href="javascript:window.print()" rel="noopener" aria-label="Print this Page">
                <span class="">
                    Print 
                </span>
            </a>
        </li>
    
        <li>
            <a class="generic-button mr-2 mb-2" href="https://getpocket.com/edit?url={!! $shareUrl !!}" target="_blank"
                rel="noopener" aria-label="Save to Pocket">
                <span class="">
                    Pocket
                </span>
            </a>
        </li>
    </ul>
</div>
