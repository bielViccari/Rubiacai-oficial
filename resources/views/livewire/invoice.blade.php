<div>
    @if ($successMessage != null)
    @script
        <script>
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: '{{ $successMessage }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endscript
@endif
    <div class="bg-white rounded-lg shadow-lg px-8 py-10 max-w-xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="text-gray-700">
                <div class="font-bold text-xl mb-2">Pedido</div>
                <div class="text-sm">Data: {{ $dataAtual }}</div>
                <div class="text-sm">Numero do pedido #: INV12345</div>
            </div>
            <button type="button" wire:click="dispatch('closeModal')"
            class="text-gray-400 bg-transparent pr-4 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
            data-modal-toggle="crud-modal">
            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Fechar modal</span>
        </button>
        </div>
        <form wire:submit='save'>
            <div class="border-b-2 border-gray-300 pb-8 mb-8">
                <h2 class="text-2xl font-bold mb-4">Pagamento em nome de:</h2>
                @if ($errors->has('name'))
                    <div class="mb-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-red-600">Nome</label>
                        <input wire:model='name' type="text" id="name" class="bg-red-50 border border-red-300 text-red-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 " placeholder="José Miguel" />
                        <p class="mt-2 text-sm text-red-600 ">{{ $errors->first('name') }}</p>
                    </div>
                @else
                    <div class="mb-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nome</label>
                        <input wire:model='name' type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="José Miguel" />
                    </div>
                @endif
                @if ($errors->has('phone'))
                    <div class="mb-2">
                        <label for="phone" class="block mb-2 text-sm font-medium text-red-600">Celular</label>
                        <input wire:model='phone' type="tel" id="phone" class="bg-red-50 border border-red-300 text-red-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="Ex..: (99) 9999-999" />
                        <p class="mt-2 text-sm text-red-600 ">{{ $errors->first('phone') }}</p>
                    </div>
                @else
                <div class="mb-2">
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Celular</label>
                    <input wire:model='phone' type="tel" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ex..: (99) 9999-999" />
                </div>

                @endif

                @if ($errors->has('address'))
                    <div class="mb-2">
                        <label for="address" class="block mb-2 text-sm font-medium text-red-600">Endereço para entrega</label>
                        <input wire:model='address' type="text" id="address" class="bg-red-50 border border-red-300 text-red-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="Ex..: Rua José Antônio Bonifácio, 279" />
                        <p class="mt-2 text-sm text-red-600 ">{{ $errors->first('address') }}</p>
                    </div>
                @else
                    <div class="mb-2">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Endereço para entrega</label>
                        <input wire:model='address' type="text" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    " placeholder="Ex..: Rua José Antônio Bonifácio, 279" />
                    </div>
                @endif

                @if($errors->has('payment'))
                    <div class="mb-2">
                        <label for="payment" class="block mb-2 text-sm font-medium text-red-600">Selecione um método de pagamento</label>
                        <select wire:model='payment' id="payment" class="bg-red-50 border border-red-300 text-red-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 ">
                        <option value="">Método de pagamento</option>
                        <option value="pix">Pix</option>
                        <option value="card">Cartão</option>
                        <option value="money">Dinheiro</option>
                        </select>
                        <p class="mt-2 text-sm text-red-600 ">{{ $errors->first('payment') }}</p>
                    </div>
                @else
                    <div class="mb-2">
                        <label for="payment" class="block mb-2 text-sm font-medium text-gray-900">Selecione um método de pagamento</label>
                        <select wire:model='payment' id="payment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    ">
                        <option value="">Método de pagamento</option>
                        <option value="pix">Pix</option>
                        <option value="card">Cartão</option>
                        <option value="money">Dinheiro</option>
                        </select>
                    </div>
                @endif

                @if($errors->has('delivery'))
                    <div class="mb-2">
                        <label for="delivery" class="block mb-2 text-sm font-medium text-red-600">Selecione um método de entrega</label>
                        <select id="delivery" wire:model='delivery' wire:change='isDelivery' name="delivery" class="bg-red-50 border border-red-300 text-red-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                        <option value="takeaway">Retirar na loja</option>
                        <option value="delivery">Entregar no endereço</option>
                        </select>
                        <p class="mt-2 text-sm text-red-600 ">{{ $errors->first('delivery') }}</p>
                    </div>
                @else
                    <div class="mb-2">
                        <label for="delivery" class="block mb-2 text-sm font-medium text-gray-900">Selecione um método de entrega</label>
                        <select id="delivery" name="delivery" wire:model='delivery' wire:change='isDelivery' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5    ">
                            <option value="takeaway">Retirar na loja</option>
                            <option value="delivery">Entregar no endereço</option>
                        </select>
                    </div>
                @endif
            </div>
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
                @if(isset($carrinho['acaiPersonalizado']))
                    @foreach ($carrinho['acaiPersonalizado'] as $index => $acai)
                    <tr>
                        <td class="text-gray-700 border-b border-gray-300">Açai Personalizado - valor total: R$ {{ number_format($acai['precoTotal'], 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="py-4 text-gray-700">{{ $acai['tamanho'] }}</td>
                        <td class="py-4 text-gray-700">{{ $acai['quantidade'] }}</td>
                        <td class="py-4 text-gray-700">R$ {{ number_format($unityPrice[$index], 2, ',', '.') }}</td>
                        <td class="py-4 text-gray-700">R$ {{ isset($priceOfSize) ? number_format($priceOfSize[$index], 2, ',', '.') : 0 }}</td>
                    </tr>
                    @if(isset($acai['frutas']))
                        @foreach ($acai['frutas'] as $index => $fruta)
                            <tr>
                                <td class="py-4 text-gray-700">{{ $fruta->name }}</td>
                                <td class="py-4 text-gray-700">{{ $acai['frutas_quantidade'][$index] }}</td>
                                <td class="py-4 text-gray-700">R$ {{ number_format($fruta->price, 2, ',', '.') }}</td>
                                <td class="py-4 text-gray-700">R$ {{ number_format($fruta->price * $acai['frutas_quantidade'][$index], 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if(isset($acai['adicionais']))
                    @foreach ($acai['adicionais'] as $index => $adicionais)
                        <tr>
                            <td class="py-4 text-gray-700">{{ $adicionais->name }}</td>
                            <td class="py-4 text-gray-700">{{ $acai['adicionais_quantidade'][$index] }}</td>
                            <td class="py-4 text-gray-700">R$ {{ number_format($adicionais->price, 2, ',', '.') }}</td>
                            <td class="py-4 text-gray-700">R$ {{ number_format($adicionais->price * $acai['adicionais_quantidade'][$index], 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endif
                @endforeach
                @endif

                @if (isset($carrinho))
                    <tr>
                        <td class="text-gray-700 border-b border-gray-300 mt-4">Produtos separados</td>
                    </tr>
                    @foreach ($carrinho as $c)
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
            <div class="text-gray-700">R$  {{ $valorEntrega == 1 ? number_format($totalPrice - $valorEntrega, 2, ',', '.') : number_format($totalPrice, 2, ',', '.') }} </div>
        </div>
        <div class="text-right mb-8">
            <div class="text-gray-700 mr-2">Entrega:</div>
            <div class="text-gray-700">R${{ number_format($valorEntrega, 2, ',', '.') }}</div>
        </div>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Total:</div>
            <div class="text-gray-700 font-bold text-xl">R$  {{ number_format($totalPrice, 2, ',', '.') }}</div>
        </div>
        <div class="border-t-2 border-gray-300 pt-8 mb-8">
            <div class="text-gray-700 mb-2">O pedido será enviado no seu whatsapp para confirmação. E então seu pedido será entregue.</div>
            <div class="text-gray-700 mb-2">Verifique no seu whatsApp, uma mensagem chegará no numero informado acima.</div>
            <div class="text-gray-700">Informe os dados corretos, em caso de não responder a mensagem, o pedido não será realizado.</div>
        </div>
        <button type="submit" class="group inline-flex w-full items-center justify-center rounded-md bg-purple-500 px-6 py-4 text-lg font-semibold text-white transition-all duration-200 ease-in-out focus:shadow hover:bg-purple-800">
            Finalizar pedido
            <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:ml-8 ml-4 h-6 w-6 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </button>
    </form>
    </div>

</div>
