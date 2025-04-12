@foreach($kyc->activities as $activity)
    <div class="mb-3">
        <div class="fw-bold text-dark">
            🕒 Updated by {{ optional($activity->causer)->name ?? 'System' }} on {{ $activity->created_at->format('F d, Y \a\t h:i A') }}
        </div>
        @if($activity->properties['attributes'] ?? false)
            <ul class="text-muted small mb-2">
                @foreach($activity->properties['attributes'] as $key => $new)
                    @php
                        $old = $activity->properties['old'][$key] ?? null;
                        if ($old === $new) continue;

                        $fieldLabels = [
                            'identy_proof_status' => 'Identity Proof Status',
                            'identy_proof_remarks' => 'Identity Proof Remarks',
                            'address_proof_status' => 'Address Proof Status',
                            'address_proof_remarks' => 'Address Proof Remarks',
                            'pan_card_proof_status' => 'PAN Card Status',
                            'pan_card_proof_remarks' => 'PAN Card Remarks',
                            'bank_ac_proof_status' => 'Bank Proof Status',
                            'bank_ac_proof_remarks' => 'Bank Remarks',
                            'is_confirmed' => 'Confirmation Status',
                        ];

                        $statusMap = ['0' => 'Pending', '1' => 'Completed', '2' => 'Cancelled'];
                        $label = $fieldLabels[$key] ?? ucfirst(str_replace('_', ' ', $key));
                        $oldFormatted = $statusMap[$old] ?? $old;
                        $newFormatted = $statusMap[$new] ?? $new;
                    @endphp

                    <li>
                        {{ $label }} changed from 
                        <strong>{{ $oldFormatted ?: 'Empty' }}</strong> 
                        to <strong>{{ $newFormatted ?: 'Empty' }}</strong>
                    </li>
                @endforeach
            </ul>
            <hr>
        @endif
    </div>
@endforeach

@if($kyc->activities->isEmpty())
    <p class="text-muted">No history found for this user.</p>
@endif
