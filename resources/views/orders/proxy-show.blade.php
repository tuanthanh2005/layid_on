@extends('layouts.app')

@section('content')
<div class="proxy-order-page">
    <style>
        .proxy-order-page {
            padding: 30px 0 42px;
        }

        .proxy-order-shell {
            display: grid;
            gap: 22px;
        }

        .proxy-order-head {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 16px;
        }

        .proxy-order-head h1 {
            margin: 0 0 6px;
            font-size: 1.95rem;
            line-height: 1.1;
        }

        .proxy-order-head p {
            margin: 0;
            color: var(--text-secondary);
        }

        .proxy-order-card {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid rgba(148, 163, 184, 0.16);
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.06);
        }

        .proxy-order-summary {
            padding: 24px;
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 16px;
            align-items: center;
        }

        .proxy-order-summary h2 {
            margin: 4px 0;
            font-size: 1.35rem;
        }

        .proxy-order-sub {
            color: var(--text-secondary);
        }

        .proxy-order-total {
            text-align: right;
        }

        .proxy-order-total strong {
            display: block;
            font-size: 2rem;
            color: #dc2626;
            line-height: 1;
        }

        .proxy-order-status {
            padding: 22px 24px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .proxy-status-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 999px;
            font-weight: 700;
        }

        .proxy-status-chip.success { background: #dcfce7; color: #166534; }
        .proxy-status-chip.warning { background: #fef3c7; color: #92400e; }
        .proxy-status-chip.info { background: #dbeafe; color: #1d4ed8; }
        .proxy-status-chip.danger { background: #fee2e2; color: #b91c1c; }

        .proxy-order-alert {
            display: flex;
            gap: 14px;
            padding: 22px 24px;
            border-radius: 24px;
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
        }

        .proxy-delivery {
            padding: 24px;
        }

        .proxy-delivery h3 {
            margin: 0 0 16px;
            font-size: 1.4rem;
        }

        .proxy-delivery-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .proxy-delivery-item,
        .proxy-delivery-block {
            padding: 16px;
            border-radius: 20px;
            background: #f8fafc;
            border: 1px solid rgba(148, 163, 184, 0.16);
        }

        .proxy-delivery-item span,
        .proxy-delivery-block span {
            display: block;
            margin-bottom: 6px;
            color: #64748b;
            font-size: 0.82rem;
        }

        .proxy-delivery-item strong,
        .proxy-delivery-block div {
            color: #0f172a;
            line-height: 1.7;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .proxy-delivery-block {
            grid-column: 1 / -1;
        }

        @media (max-width: 768px) {
            .proxy-order-head,
            .proxy-order-summary {
                display: grid;
            }

            .proxy-order-total {
                text-align: left;
            }

            .proxy-delivery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @php
        $statusMeta = match($proxyOrder->status) {
            'completed' => ['Da cap proxy', 'success', 'fa-circle-check'],
            'processing' => ['Dang cap proxy', 'info', 'fa-gears'],
            'cancelled' => ['Don da huy', 'danger', 'fa-circle-xmark'],
            default => ['Cho xu ly', 'warning', 'fa-hourglass-half'],
        };
    @endphp

    <div class="proxy-order-shell">
        <div class="proxy-order-head">
            <div>
                <h1>Don Proxy #{{ $proxyOrder->order_number }}</h1>
                <p>Trang nay se tu dong lam moi khi admin cap du lieu proxy cho ban.</p>
            </div>
            <a href="{{ route('orders.index') }}" class="btn btn-outline">Quay lai don hang</a>
        </div>

        <section class="proxy-order-card">
            <div class="proxy-order-summary">
                <div>
                    <div class="small text-muted">Goi da mua</div>
                    <h2>{{ $proxyOrder->proxy_name }}</h2>
                    <div class="proxy-order-sub">{{ $proxyOrder->proxy_type }} / {{ $proxyOrder->proxy_protocol }} / So luong: {{ $proxyOrder->quantity }}</div>
                </div>
                <div class="proxy-order-total">
                    <div class="small text-muted">Tong thanh toan</div>
                    <strong>{{ number_format($proxyOrder->total_amount) }}d</strong>
                </div>
            </div>

            <div class="proxy-order-status">
                <div>
                    <div class="small text-muted mb-2">Trang thai don</div>
                    <span class="proxy-status-chip {{ $statusMeta[1] }}">
                        <i class="fa-solid {{ $statusMeta[2] }}"></i>{{ $statusMeta[0] }}
                    </span>
                </div>
                <div>
                    <div class="small text-muted mb-2">Thanh toan</div>
                    <strong>
                        {{ match($proxyOrder->payment_status) {
                            'paid' => 'Da xac nhan',
                            'refunded' => 'Da hoan tien',
                            default => 'Da gui yeu cau xac nhan',
                        } }}
                    </strong>
                </div>
            </div>
        </section>

        @if(in_array($proxyOrder->status, ['pending', 'processing']))
        <section class="proxy-order-alert">
            <div class="fs-3"><i class="fa-solid fa-bell-concierge"></i></div>
            <div>
                <strong style="display:block; margin-bottom:6px;">Don dang cho admin xu ly</strong>
                <div>He thong dang tu dong lam moi de show ngay host, port, user, pass va huong dan su dung khi admin bam duyet.</div>
            </div>
        </section>
        @endif

        @if($proxyOrder->status === 'completed')
        <section class="proxy-order-card proxy-delivery">
            <h3>Thong tin proxy da duoc cap</h3>
            <div class="proxy-delivery-grid">
                <div class="proxy-delivery-item"><span>Host</span><strong>{{ $proxyOrder->proxy_host }}</strong></div>
                <div class="proxy-delivery-item"><span>Port</span><strong>{{ $proxyOrder->proxy_port }}</strong></div>
                <div class="proxy-delivery-item"><span>Username</span><strong>{{ $proxyOrder->proxy_username }}</strong></div>
                <div class="proxy-delivery-item"><span>Password</span><strong>{{ $proxyOrder->proxy_password }}</strong></div>
                <div class="proxy-delivery-item"><span>Protocol</span><strong>{{ $proxyOrder->proxy_protocol_delivered }}</strong></div>
                <div class="proxy-delivery-item"><span>Han su dung</span><strong>{{ $proxyOrder->proxy_expires_at?->format('d/m/Y H:i') ?: 'Chua gioi han / lien he admin' }}</strong></div>
                <div class="proxy-delivery-item"><span>Whitelist IP</span><strong>{{ $proxyOrder->proxy_whitelist ?: 'Khong yeu cau' }}</strong></div>
                <div class="proxy-delivery-item"><span>Gioi han ket noi</span><strong>{{ $proxyOrder->proxy_connection_limit ?: 'Theo thong tin admin cap' }}</strong></div>
                <div class="proxy-delivery-block"><span>Danh sach IP / Endpoint</span><div>{{ $proxyOrder->proxy_ip_list ?: 'Cap theo host/port o tren' }}</div></div>
                <div class="proxy-delivery-block"><span>Huong dan su dung</span><div>{{ $proxyOrder->proxy_setup_guide }}</div></div>
                <div class="proxy-delivery-block"><span>Ghi chu giao hang</span><div>{{ $proxyOrder->delivery_note ?: 'Khong co ghi chu them.' }}</div></div>
            </div>
        </section>
        @endif
    </div>
</div>

@if(in_array($proxyOrder->status, ['pending', 'processing']))
<script>
    setTimeout(function () {
        window.location.reload();
    }, 8000);
</script>
@endif
@endsection
