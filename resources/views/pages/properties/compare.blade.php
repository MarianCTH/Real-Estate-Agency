@extends('layouts.app')
@section('title', 'Compară proprietăți')

@section('content')
<section class="properties-comparison position-relative">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h3 class="text-primary mb-2">PROPRIETĂȚI</h3>
            <h2 class="mb-4">COMPARAȚIE PROPRIETĂȚI</h2>
        </div>

        @if($properties->isEmpty())
            <div class="empty-state text-center py-5">
                <div class="empty-state-icon mb-4">
                    <i class="fas fa-building fa-3x text-muted"></i>
                </div>
                <h4 class="mb-3">Nu aveți proprietăți selectate pentru comparare</h4>
                <p class="text-muted mb-4">Navigați la lista de proprietăți și selectați până la 3 proprietăți pentru comparare.</p>
                <a href="{{ route('properties') }}" class="btn btn-primary px-4 py-2">
                    <i class="fas fa-search mr-2"></i>Vezi proprietăți
                </a>
            </div>
        @else
            <div class="comparison-wrapper bg-white rounded-lg shadow-sm">
                <!-- Properties Cards -->
                <div class="row g-0">
                    <div class="col-12">
                        <div class="property-cards-container p-4">
                            <div class="row">
                                @foreach($properties as $property)
                                    <div class="col-md-4 mb-4">
                                        <div class="property-card h-100 rounded-lg overflow-hidden">
                                            <div class="property-image position-relative">
                                                <img src="/img/properties/{{ $property->id }}/{{ $property->image }}" 
                                                     alt="{{ $property->title }}" 
                                                     class="w-100"
                                                     style="height: 220px; object-fit: cover;">
                                                <button class="remove-from-compare btn-close-custom" 
                                                        data-id="{{ $property->id }}"
                                                        type="button">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                <div class="property-price">
                                                    <span>€ {{ number_format($property->price, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                            <div class="property-info p-3">
                                                <h3 class="h5 mb-3 property-title">
                                                    <a href="{{ route('property.show', $property->id) }}">
                                                        {{ $property->title }}
                                                    </a>
                                                </h3>
                                                <div class="property-location">
                                                    <i class="fa fa-map-marker text-primary"></i>
                                                    <span>{{ $property->location }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comparison Details -->
                <div class="comparison-details px-4 pb-4">
                    <div class="comparison-table">
                        <div class="table-row header">
                            <div class="table-cell"></div>
                            @foreach($properties as $property)
                                <div class="table-cell">Detalii</div>
                            @endforeach
                        </div>

                        <div class="table-row">
                            <div class="table-cell feature">Preț</div>
                            @foreach($properties as $property)
                                <div class="table-cell">€ {{ number_format($property->price, 0, ',', '.') }}</div>
                            @endforeach
                        </div>

                        <div class="table-row">
                            <div class="table-cell feature">Tip proprietate</div>
                            @foreach($properties as $property)
                                <div class="table-cell">{{ $property->type->name }}</div>
                            @endforeach
                        </div>

                        <div class="table-row">
                            <div class="table-cell feature">Status</div>
                            @foreach($properties as $property)
                                <div class="table-cell">
                                    <span class="status-badge">{{ $property->status->name }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="table-row">
                            <div class="table-cell feature">Suprafață</div>
                            @foreach($properties as $property)
                                <div class="table-cell">{{ $property->size }} m²</div>
                            @endforeach
                        </div>

                        <div class="table-row">
                            <div class="table-cell feature">Dormitoare</div>
                            @foreach($properties as $property)
                                <div class="table-cell">
                                    <i class="fas fa-bed text-primary mr-1"></i> {{ $property->bedrooms }}
                                </div>
                            @endforeach
                        </div>

                        <div class="table-row">
                            <div class="table-cell feature">Băi</div>
                            @foreach($properties as $property)
                                <div class="table-cell">
                                    <i class="fas fa-bath text-primary mr-1"></i> {{ $property->bathrooms }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Clear Comparison Button -->
                    <div class="text-center mt-5">
                        <button id="clear-compare" class="btn btn-danger px-4 py-2" type="button">
                            <i class="fas fa-trash-alt mr-2"></i> Șterge lista de comparație
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
.properties-comparison {
    padding: 60px 0;
    background-color: #f8f9fa;
    z-index: 1;
}

.section-title h3 {
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 1px;
}

.section-title h2 {
    font-size: 2rem;
    font-weight: 700;
}

.empty-state {
    background: white;
    border-radius: 8px;
    padding: 40px;
}

.empty-state-icon {
    color: #e9ecef;
}

.comparison-wrapper {
    border-radius: 12px;
    overflow: hidden;
}

.property-card {
    border: 1px solid #eee;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background: white;
}

.property-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.property-image {
    position: relative;
    overflow: hidden;
}

.btn-close-custom {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(220, 53, 69, 0.9);
    color: white;
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-close-custom:hover {
    background: #dc3545;
    transform: scale(1.1);
}

.property-price {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 15px;
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
    color: white;
    font-size: 1.25rem;
    font-weight: 600;
}

.property-title a {
    color: #2c3e50;
    text-decoration: none;
    transition: color 0.2s ease;
}

.property-title a:hover {
    color: #274abb;
}

.property-location {
    color: #6c757d;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

.comparison-details {
    background: white;
}

.comparison-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 1px;
}

.table-row {
    display: flex;
    border-bottom: 1px solid #eee;
}

.table-row:last-child {
    border-bottom: none;
}

.table-cell {
    flex: 1;
    padding: 15px;
    display: flex;
    align-items: center;
}

.table-cell.feature {
    background: #f8f9fa;
    font-weight: 600;
    color: #2c3e50;
    min-width: 150px;
}

.status-badge {
    background: #274abb;
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
}

.btn-danger {
    background: #dc3545;
    border: none;
    transition: all 0.3s ease;
}

.btn-danger:hover {
    background: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
}

@media (max-width: 768px) {
    .table-row {
        flex-direction: column;
    }
    
    .table-cell {
        padding: 10px;
    }
    
    .table-cell.feature {
        background: #f8f9fa;
        width: 100%;
    }
}

.property-location i {
    font-size: 16px;
    width: 16px;
    height: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.property-location .fa-map-marker {
    margin-right: 8px;
}
</style>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    // Function to show toast notification
    function showToast(message) {
        const toast = document.getElementById('compare-toast');
        if (toast) {
            toast.textContent = message;
            toast.style.display = 'block';
            setTimeout(() => {
                toast.style.display = 'none';
            }, 2000);
        }
    }

    // Function to update comparison count in navigation
    function updateCompareCount(count) {
        const compareLink = $('a[href="{{ route('property.compare') }}"]');
        const existingCount = compareLink.find('.compare-count');
        
        if (count > 0) {
            if (existingCount.length) {
                existingCount.text(count);
            } else {
                compareLink.append(`<span class="compare-count">${count}</span>`);
            }
        } else {
            existingCount.remove();
        }
    }

    // Function to handle property removal
    function removeProperty(propertyId) {
        console.log('Attempting to remove property:', propertyId);
        
        $.ajax({
            url: `/properties/${propertyId}/remove-from-compare`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Response:', response);
                if (response.success) {
                    // Update the comparison count first
                    updateCompareCount(response.count);
                    
                    // Find the property card
                    const propertyCard = $(`.remove-from-compare[data-id="${propertyId}"]`).closest('.col-md-4, .col-md-6');
                    
                    // Get the index before removal for table cell deletion
                    const cardContainer = propertyCard.parent();
                    const allCards = cardContainer.children('.col-md-4, .col-md-6');
                    const cardIndex = allCards.index(propertyCard);
                    
                    console.log('Found property card:', propertyCard.length, 'at index:', cardIndex);
                    
                    if (propertyCard.length) {
                        // Remove the property card with animation
                        propertyCard.fadeOut(300, function() {
                            // Remove the card from DOM
                            $(this).remove();
                            
                            // Remove corresponding cells from comparison table
                            $('.comparison-table .table-row').each(function() {
                                const cellToRemove = $(this).find(`.table-cell:eq(${cardIndex + 1})`);
                                cellToRemove.fadeOut(300, function() {
                                    $(this).remove();
                                });
                            });
                            
                            // Get remaining cards after removal
                            const remainingCards = $('.property-card').length;
                            console.log('Remaining cards:', remainingCards);
                            
                            if (remainingCards <= 1 || response.count <= 1) {
                                showToast('Nu se poate face comparație cu o singură proprietate');
                                setTimeout(() => {
                                    window.location.href = '{{ route("welcome") }}';
                                }, 1500);
                            } else {
                                // Update the layout for remaining cards
                                const remainingCardContainers = $('.property-cards-container .col-md-4, .property-cards-container .col-md-6');
                                remainingCardContainers.removeClass('col-md-4 col-md-6').addClass('col-md-6');
                                
                                // Update table layout
                                $('.comparison-table').css('width', '100%');
                                $('.table-cell').css('flex', '1');
                            }
                        });
                    }
                    
                    showToast(response.message);
                } else {
                    showToast(response.message || 'A apărut o eroare la eliminarea proprietății');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax error:', error);
                showToast('A apărut o eroare la eliminarea proprietății');
            }
        });
    }

    // Function to update comparison table layout
    function updateComparisonTable() {
        const remainingCards = $('.property-card');
        console.log('Updating table layout, remaining cards:', remainingCards.length);
        
        if (remainingCards.length === 2) {
            // Find all property card containers and update their classes
            $('.property-cards-container .col-md-4').each(function() {
                $(this).removeClass('col-md-4').addClass('col-md-6');
            });
        }
    }

    // Handle removing individual properties from comparison
    $(document).on('click', '.btn-close-custom', function(e) {
        console.log('Remove button clicked');
        e.preventDefault();
        e.stopPropagation();
        const propertyId = $(this).data('id');
        console.log('Property ID from button:', propertyId);
        removeProperty(propertyId);
    });

    // Handle clearing all properties from comparison
    $('#clear-compare').on('click', function(e) {
        console.log('Clear button clicked');
        e.preventDefault();
        
        if (!confirm('Sigur doriți să ștergeți toate proprietățile din lista de comparație?')) {
            console.log('Clear operation cancelled by user');
            return;
        }
        
        $.ajax({
            url: '/properties/clear-compare',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Response:', response);
                if (response.success) {
                    updateCompareCount(0);
                    showToast('Toate proprietățile au fost eliminate din comparație');
                    setTimeout(() => {
                        window.location.href = '{{ route("welcome") }}';
                    }, 1500);
                } else {
                    showToast(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax error:', error);
                showToast('A apărut o eroare la ștergerea listei de comparație');
            }
        });
    });
});
</script>
@endpush 

