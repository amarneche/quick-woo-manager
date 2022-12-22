
<link rel="stylesheet" href="{{asset("assets/plugins/jquery-toast/jquery.toast.min.css")}}">
<script src="{{asset("assets/plugins/jquery-toast/jquery.toast.min.js")}}" ></script>

    
    @if(session()->has('success'))
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $.toast({
                    heading: 'Succès',
                    text: "{{ session('success') }}",
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 5000,
                    stack: 6
                });
            }, 1000);
        })
    </script>
    @endif
    
    @foreach($errors as $error)
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $.toast({
                    heading: 'Erreur',
                    text: "{{ $message }}",
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'danger',
                    hideAfter: 5000,
                    stack: 6
                });
            }, 1000);
        })
    </script>
    @endforeach
    
