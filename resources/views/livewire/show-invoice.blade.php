<div>
    <div class="bg-white rounded-lg shadow-lg px-8 py-10 max-w-xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="text-gray-700">
                <div class="font-bold text-xl mb-2">Pedido - {{ $order->name }}</div>
                <div class="text-sm">Data: {{ $order->created_at }}</div>
                <div class="text-sm">Numero do pedido #: INV12345</div>

            </div>

        </div>
        <form wire:submit='update'>
            <h1
                class="block mb-2 justify-center text-center text-lg font-medium text-gray-900 dark:text-white uppercase">
                Alterar Status do Pedido</h1>
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecione o status
                do pedido</label>
            <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Atual: <span
                    class="{{ $order->status === 'd' ? 'text-green-500' : ($order->status === 'i' ? 'text-yellow-500' : 'text-red-500') }}">{{ $order->status === 'd' ? 'Entregue' : ($order->status === 'i' ? 'Em Processo' : 'Não Entregue') }}</span></span>
            @if ($errors->has('status'))
                <select id="status" wire:model='status'
                    class="bg-red-50 border border-red-300 text-red-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                    <option>Escolher</option>
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
                            <td class="py-4 text-gray-700">R$ {{ number_format($unityPrice[$index], 2, ',', '.') }}</td>
                            <td class="py-4 text-gray-700">R$
                                {{ isset($priceOfSize) ? number_format($priceOfSize[$index], 2, ',', '.') : 0 }}</td>
                        </tr>
                        <tr class="">
                            <td class="pb-12">Observação: {{ $acai['observacao'] != null ? $acai['observacao'] : '' }}
                            </td>
                        </tr>
                        @if (isset($acai['frutas']))
                            <tr>
                                <td class="text-gray-700 border-b border-gray-300">Frutas</td>
                            </tr>
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
                            <tr>
                                <td class="text-gray-700 border-b border-gray-300">Adicionais</td>
                            </tr>
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
