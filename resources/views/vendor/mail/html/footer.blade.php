<tr>
    <td>
        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">

            <tr>
                <td align="center" style="padding-bottom: 15px;">
                    <img src="{{ asset('img/logo-removebg-preview.png') }}"
                         width="70"
                         alt="Mooré Connections Logo">
                </td>
            </tr>

            <tr>
                <td class="content-cell" align="center">
                    {{ Illuminate\Mail\Markdown::parse($slot) }}
                </td>
            </tr>

        </table>
    </td>
</tr>