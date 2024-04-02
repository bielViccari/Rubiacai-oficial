<div>
    <div class="bg-white rounded-lg shadow-lg px-8 py-10 max-w-xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <img class="h-8 w-8 mr-2" src="images/rubiacai.png"
                    alt="Logo" />
                <div class="text-gray-700 font-semibold text-lg">Rubiaçai</div>
            </div>
            <div class="text-gray-700">
                <div class="font-bold text-xl mb-2">Pedido</div>
                <div class="text-sm">Data: 01/05/2023</div>
                <div class="text-sm">Numero do pedido #: INV12345</div>
            </div>
        </div>
        <div class="border-b-2 border-gray-300 pb-8 mb-8">
            <h2 class="text-2xl font-bold mb-4">Pagamento em nome de:</h2>
            <div class="mb-2">
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                <input type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="José Miguel" required />
            </div>
            <div class="mb-2">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Celular</label>
                <input type="tel" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ex..: (99) 9999-999" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required />
            </div>

            <div class="mb-2">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecione um método de pagamento</label>
                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <option selected>Método de pagamento</option>
                  <option value="pix">Pix</option>
                  <option value="card">Cartão</option>
                  <option value="money">Dinheiro</option>
                </select>
            </div>
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
                @foreach ($carrinho['acaiPersonalizado'] as $acai)
                <tr>
                    <td class="text-gray-700 border-b border-gray-300">Açai Personalizado</td>
                </tr>
                <tr>
                    <td class="py-4 text-gray-700">{{ $acai['tamanho'] }}</td>
                    <td class="py-4 text-gray-700">{{ $acai['quantidade'] }}</td>
                    <td class="py-4 text-gray-700">{{ $acai['precoTotal'] }}</td>
                    <td class="py-4 text-gray-700">{{ $acai['precoTotal'] * $acai['quantidade'] }}</td>
                </tr>
                @foreach ($acai['frutas'] as $index => $fruta)
                    <tr>
                        <td class="py-4 text-gray-700">{{ $fruta->name }}</td>
                        <td class="py-4 text-gray-700">{{ $acai['frutas_quantidade'][$index] }}</td>
                        <td class="py-4 text-gray-700">{{ $fruta->price }}</td>
                        <td class="py-4 text-gray-700">{{ $fruta->price * $acai['frutas_quantidade'][$index] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="text-gray-700 border-b border-gray-300"></td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Subtotal:</div>
            <div class="text-gray-700">$425.00</div>
        </div>
        <div class="text-right mb-8">
            <div class="text-gray-700 mr-2">Entrega:</div>
            <div class="text-gray-700">R$1,00</div>
    
        </div>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Total:</div>
            <div class="text-gray-700 font-bold text-xl">$450.50</div>
        </div>
        <div class="border-t-2 border-gray-300 pt-8 mb-8">
            <div class="text-gray-700 mb-2">O pedido será enviado no seu whatsapp para confirmação. E então seu pedido será entregue.</div>
            <div class="text-gray-700 mb-2">Verifique no seu whatsApp, uma mensagem chegará no numero informado acima.</div>
            <div class="text-gray-700">Informe os dados corretos, em caso de não responder a mensagem, o pedido não será realizado.</div>
        </div>
    </div>

</div>
