<li class="{{ Request::is('generator_builder*') ? 'active' : '' }}">
    <a href="{{ route('io_generator_builder') }}"><i class="fa fa-edit"></i><span>Generador</span></a>
</li>

<li class="{{ Request::is('countries*') ? 'active' : '' }}">
    <a href="{{ route('countries.index') }}"><i class="fa fa-edit"></i><span>Countries</span></a>
</li>


<li class="{{ Request::is('provinces*') ? 'active' : '' }}">
    <a href="{{ route('provinces.index') }}"><i class="fa fa-edit"></i><span>Provinces</span></a>
</li>

<li class="{{ Request::is('cities*') ? 'active' : '' }}">
    <a href="{{ route('cities.index') }}"><i class="fa fa-edit"></i><span>Cities</span></a>
</li>

<li class="{{ Request::is('municipalities*') ? 'active' : '' }}">
    <a href="{{ route('municipalities.index') }}"><i class="fa fa-edit"></i><span>Municipalities</span></a>
</li>

<li class="{{ Request::is('neighborhoods*') ? 'active' : '' }}">
    <a href="{{ route('neighborhoods.index') }}"><i class="fa fa-edit"></i><span>Neighborhoods</span></a>
</li>

<li class="{{ Request::is('accounts*') ? 'active' : '' }}">
    <a href="{{ route('accounts.index') }}"><i class="fa fa-edit"></i><span>Accounts</span></a>
</li>

<li class="{{ Request::is('taxes*') ? 'active' : '' }}">
    <a href="{{ route('taxes.index') }}"><i class="fa fa-edit"></i><span>Taxes</span></a>
</li>

<li class="{{ Request::is('statuses*') ? 'active' : '' }}">
    <a href="{{ route('statuses.index') }}"><i class="fa fa-edit"></i><span>Statuses</span></a>
</li>

<li class="{{ Request::is('propertyTypes*') ? 'active' : '' }}">
    <a href="{{ route('propertyTypes.index') }}"><i class="fa fa-edit"></i><span>Property Types</span></a>
</li>

<li class="{{ Request::is('properties*') ? 'active' : '' }}">
    <a href="{{ route('properties.index') }}"><i class="fa fa-edit"></i><span>Properties</span></a>
</li>

<li class="{{ Request::is('currencies*') ? 'active' : '' }}">
    <a href="{{ route('currencies.index') }}"><i class="fa fa-edit"></i><span>Currencies</span></a>
</li>

<li class="{{ Request::is('expenses*') ? 'active' : '' }}">
    <a href="{{ route('expenses.index') }}"><i class="fa fa-edit"></i><span>Expenses</span></a>
</li>

<li class="{{ Request::is('transactionTypes*') ? 'active' : '' }}">
    <a href="{{ route('transactionTypes.index') }}"><i class="fa fa-edit"></i><span>Transaction Types</span></a>
</li>

<li class="{{ Request::is('publications*') ? 'active' : '' }}">
    <a href="{{ route('publications.index') }}"><i class="fa fa-edit"></i><span>Publications</span></a>
</li>

<li class="{{ Request::is('images*') ? 'active' : '' }}">
    <a href="{{ route('images.index') }}"><i class="fa fa-edit"></i><span>Images</span></a>
</li>


<li class="{{ Request::is('transactions*') ? 'active' : '' }}">
    <a href="{{ route('transactions.index') }}"><i class="fa fa-edit"></i><span>Transactions</span></a>
</li>

<li class="{{ Request::is('features*') ? 'active' : '' }}">
    <a href="{{ route('features.index') }}"><i class="fa fa-edit"></i><span>Features</span></a>
</li>

