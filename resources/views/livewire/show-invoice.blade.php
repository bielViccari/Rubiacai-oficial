<div>
    @if ($successMessage != null)
    @script
        <script>
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: '{{ $successMessage }}',
                showConfirmButton: false,
                timer: 1000
            });
        </script>
    @endscript
    @endif
    <div class="bg-white rounded-lg shadow-lg px-8 py-10 max-w-xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="text-gray-700">
                <div class="font-bold text-xl mb-2">Pedido - {{ $order->name }}</div>
                <div class="text-sm">Data: {{ $order->created_at }}</div>
                <div class="text-sm">Forma de pagamento:
                    {{ $order->payment == 'card' ? 'Cartão' : ($order->payment == 'money' ? 'Dinheiro' : 'Pix') }}</div>
                <div class="text-sm">Forma de retirada:
                    {{ $order->delivery == 'takeaway' ? 'Retirar na loja' : 'Entregar no endereço' }}</div>
                @if ($order->delivery == 'delivery')
                    <div class="text-sm">Endereço de entrega: {{ $order->address }}</div>
                @endif
                <div class="text-sm">Telefone para contato: <a target="_blank" class="text-blue-500" href="https://api.whatsapp.com/send?phone={{ $order->phone }}">{{ $phoneNumber }}</a></div>
            </div>

        </div>
        <form wire:submit='update'>
            <h1
                class="block mb-2 justify-center text-center text-lg font-medium text-gray-900 dark:text-white uppercase">
                Alterar Status do Pedido</h1>
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecione o
                status
                do pedido</label>
            <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Atual: <span
                    class="{{ $order->status === 'd' ? 'text-green-500' : ($order->status === 'i' ? 'text-yellow-500' : 'text-red-500') }}">{{ $order->status === 'd' ? 'Entregue' : ($order->status === 'i' ? 'Em Processo' : 'Não Entregue') }}</span></span>
            @if ($errors->has('status'))
                <select id="status" wire:model='status'
                    class="bg-red-50 border border-red-300 text-red-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                    <option value="">Escolher</option>
                    <option value="d">Entregue</option>
                    <option value="i">Em processo</option>
                    <option value="n">Não entregue</option>
                </select>
                <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $errors->first('status') }}</span>
            @else
                <select id="status" wire:model='status'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Escolher</option>
                    <option value="d">Entregue</option>
                    <option value="i">Em processo</option>
                    <option value="n">Não entregue</option>
                </select>
            @endif
            <button type="submit"
                class="py-2 mt-6 px-4 flex justify-center items-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg">
                Alterar Status do pedido
            </button>
        </form>

        <table class="w-full text-left mb-8">
            <thead>
                <tr>
                    <th class="text-gray-700 font-bold uppercase py-2">Produtos</th>
                    <th class="text-gray-700 font-bold uppercase py-2">Quantidade</th>
                    <th class="text-gray-700 font-bold uppercase py-2">Preço</th>
                    <th class="text-gray-700 font-bold uppercase py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($order->itens['acaiPersonalizado']))
                    @foreach ($order->itens['acaiPersonalizado'] as $index => $acai)
                        <tr>
                            <td class="text-gray-700 border-b border-gray-300">Açai Personalizado</td>
                        </tr>
                        <tr>
                            <td class="py-4 text-gray-700">{{ $acai['tamanho'] }}</td>
                            <td class="py-4 text-gray-700">{{ $acai['quantidade'] }}</td>
                            <td class="py-4 text-gray-700">R$ {{ number_format($unityPrice[$index], 2, ',', '.') }}
                            </td>
                            <td class="py-4 text-gray-700">R$
                                {{ isset($priceOfSize) ? number_format($priceOfSize[$index], 2, ',', '.') : 0 }}</td>
                        </tr>
                        @if (isset($acai['frutas']))
                            @foreach ($acai['frutas'] as $index => $fruta)
                                <tr>
                                    <td class="py-4 text-gray-700">{{ $fruta['name'] }}</td>
                                    <td class="py-4 text-gray-700">{{ $acai['frutas_quantidade'][$index] }}</td>
                                    <td class="py-4 text-gray-700">R$ {{ number_format($fruta['price'], 2, ',', '.') }}
                                    </td>
                                    <td class="py-4 text-gray-700">R$
                                        {{ number_format($fruta['price'] * $acai['frutas_quantidade'][$index], 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        @if (isset($acai['adicionais']))
                            @foreach ($acai['adicionais'] as $index => $adicionais)
                                <tr>
                                    <td class="py-4 text-gray-700">{{ $adicionais['name'] }}</td>
                                    <td class="py-4 text-gray-700">{{ $acai['adicionais_quantidade'][$index] }}</td>
                                    <td class="py-4 text-gray-700">R$
                                        {{ number_format($adicionais['price'], 2, ',', '.') }}</td>
                                    <td class="py-4 text-gray-700">R$
                                        {{ number_format($adicionais['price'] * $acai['adicionais_quantidade'][$index], 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        <tr class="">
                            <td>Observação: {{ $acai['observacao'] != null ? $acai['observacao'] : '' }}
                            </td>
                            <hr>
                        </tr>
                    @endforeach
                @endif

                @if (isset($order))
                    <tr>
                        <td class="text-gray-700 border-b border-gray-300">Produtos separados</td>
                    </tr>
                    @foreach ($order as $c)
                        @if (isset($c['name']))
                            <tr>
                                <td class="py-4 text-gray-700">{{ $c['name'] }}</td>
                                <td>{{ $c['quantity'] }}</td>
                                <td class="py-4 text-gray-700">R$ {{ number_format($c['price'], 2, ',', '.') }}</td>
                                <td class="py-4 text-gray-700">R$ {{ number_format($c['price'], 2, ',', '.') }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endif

            </tbody>
        </table>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Subtotal:</div>
            <div class="text-gray-700">R$ {{ number_format($precoTotal, 2, ',', '.') }} </div>
        </div>
        <div class="text-right mb-8">
            <div class="text-gray-700 mr-2">Entrega:</div>
            <div class="text-gray-700">R${{ number_format($valorEntrega, 2, ',', '.') }}</div>

        </div>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Total:</div>
            <div class="text-gray-700 font-bold text-xl">R$ {{ number_format($precoTotal + 1, 2, ',', '.') }}</div>
        </div>
    </div>

</div>
