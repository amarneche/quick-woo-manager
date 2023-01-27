<!-- Modal trigger button -->


<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->

<div class="modal fade" id="schedule-modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
        <form action="" method="post" id="schedule">
            @method('post')
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">{{ __('Schedule this product to be shared') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Schedule') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Optional: Place to the bottom of scripts -->
<script>
    $(document).ready(function () {
        $('.schedule').on('click', function(){
            $('form#schedule').attr('action',$(this).data('action'));
        })
    });
</script>
