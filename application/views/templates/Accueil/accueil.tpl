{extends file='../layout.tpl'}
{block name=body}
{if $inscription_success == TRUE }
<p>Inscription Réussie</p>
{elseif isset($inscription_success) && $inscription_success == FALSE}
<p>Erreur lors de l'inscription. MErci de contacter un administrateur.</p>
{/if}

{/block}
