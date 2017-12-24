@extends('layouts.frontend.app')
@section('content')
    <?php echo \Html::getHtml('Core\Template', 'frontend\common\header.phtml', ['user' => $user]);?>
    <?php echo \Html::getHtml('Core\Template', 'frontend\common\footer.phtml');?>
    <?php echo $user->name?>

@endsection