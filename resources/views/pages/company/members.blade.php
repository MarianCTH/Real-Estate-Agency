@extends('layouts.userpanel')
@section('title', $title)


@section('content')
    <div class="my-properties">
        <div class="widget-boxed-header">
            <h4>Membrii societății {{ $company->name }}</h4>
        </div>
        <table class="table-responsive">
            <thead>
                <tr>
                    <th class="pl-2">Membru</th>
                    <th class="p-0"></th>
                    <th>Creat la</th>
                    <th>Anunțuri postate</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($company->members as $member)
                <tr>
                    <td class="image myelist">
                        <a href=""><img alt="property-image" style="width:80px" src="{{ asset('img/users/' . $member->image) }}" class="img-fluid"></a>
                    </td>
                    <td>
                        <div class="inner">
                            <a href=""><h2>{{ $member->name }}</h2></a>
                            <figure><i class="lni lni-map-marker"></i> {{ $member->address ?? '' }}</figure>
                        </div>
                    </td>
                    <td>{{ $member->created_at->format('d-m-Y') }}</td> <!-- Join date -->
                    <td>{{ $member->properties()->count() }}</td> <!-- Post count -->
                    <td>
                        @if(auth()->id() === $company->leader_id && $member->id !== $company->leader_id)
                            <form action="{{ route('companies.members.remove', [$company->id, $member->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Elimină</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach

                @foreach($company->joinRequests as $request)
                @if($request->status === 'pending')
                <tr>
                    <td class="image myelist">
                        <a href=""><img alt="property-image" src="{{ asset('img/users/' . $request->user->image) }}" class="img-fluid"></a>
                    </td>
                    <td>
                        <div class="inner">
                            <a href=""><h2>{{ $request->user->name }}</h2></a>
                            <figure><i class="lni lni-map-marker"></i> {{ $request->user->address ?? 'N/A' }}</figure>
                        </div>
                    </td>
                    <td>—</td> <!-- No acceptance date yet -->
                    <td>—</td> <!-- No posts yet -->
                    <td>
                        <form action="{{ route('companies.approveJoinRequest', ['company' => $company->id, 'request' => $request->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Aprobă</button>
                        </form>
                        <form action="{{ route('companies.rejectJoinRequest', ['company' => $company->id, 'request' => $request->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Respinge</button>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

@endsection
@section('includes-js')
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/mmenu.min.js') }}"></script>
    <script src="{{ asset('js/mmenu.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/slick2.js') }}"></script>
    <script src="{{ asset('js/fitvids.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/smooth-scroll.min.js') }}"></script>
    <script src="{{ asset('js/lightcase.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/newsletter.js') }}"></script>
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/searched.js') }}"></script>
    <script src="{{ asset('js/dashbord-mobile-menu.js') }}"></script>
    <script src="{{ asset('js/forms-2.js') }}"></script>
    <script src="{{ asset('js/color-switcher.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
