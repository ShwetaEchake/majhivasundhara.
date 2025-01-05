<x-mail::message>
# स्पर्धा यशस्वीरित्या सादर केली !!

स्पर्धेत भाग घेतल्याबद्दल धन्यवाद, तुम्ही {{ $marks }} + {{ $paryavaran_marks }} = {{ $marks+$paryavaran_marks }} गुणांचा यशस्वीपणे दावा केला आहे.

{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
