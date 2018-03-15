<style>
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 60px;
        line-height: 60px; /* Vertically center the text there */
        background-color: #f5f5f5;
    }
</style>

<footer class="footer">
    <div class="container">
        {{--remove padding from p, so there is no space under footer--}}
        <p class="float-right" style="padding: 0;margin: 0"><a href="#">Back to top</a></p>
        <p style="padding: 0;margin: 0">&copy; 2018 {{ config('app.name', 'Laravel') }}, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </div>
</footer>