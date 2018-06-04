
<template>
	<div class="cv-header">
		<div class="cv-header-nav">
			<button :disabled="!headerProps.previousYear" class="previousYear btn btn-info" @click="onInput(headerProps.previousYear)"><i class="icon-control-rewind"></i> Año</button>
			<button :disabled="!headerProps.previousPeriod" class="previousPeriod btn btn-warning" @click="onInput(headerProps.previousPeriod)"><i class="icon-control-start"></i> Mes</button>
			<button :disabled="!headerProps.nextPeriod" class="nextPeriod btn btn-warning" @click="onInput(headerProps.nextPeriod)">Mes <i class="icon-control-end"></i></button>
			<button :disabled="!headerProps.nextYear" class="nextYear btn btn-info" @click="onInput(headerProps.nextYear)">Año <i class="icon-control-forward"></i></button>
			<button class="currentPeriod btn btn-success" @click="onInput(headerProps.currentPeriod)"> <i class="icon-event"></i> Today</button>
		</div>
		<div class="periodLabel">
			<slot name="label"/>
		</div>
	</div>
</template>
<script>
export default {
	name: "CalendarViewHeader",
	props: {
		headerProps: {
			type: Object,
			required: true,
		},
	},
	methods: {
		onInput(d) {
			this.$emit("input", d)
		},
	},
}
</script>
<style>
.cv-header {
	display: flex;
	flex: 0 1 auto;
	flex-flow: row nowrap;
	align-items: center;
	min-height: 2.5em;
	border-width: 1px 1px 0 1px;
	background-color: #F0F3F5;
}
.cv-header-nav{
	background-color: #F0F3F5;
}

.cv-header .periodLabel {
	display: flex;
	flex: 1 1 auto;
	flex-flow: row nowrap;
	min-height: 1.5em;
	line-height: 1;
	font-size: 1.5em;
}

.cv-header,
.cv-header button {
	border-style: solid;
	border-color: #ddd;

}

.cv-header-nav,
.cv-header .periodLabel {
	margin: 0.1em 0.6em;
}

.cv-header-nav button,
.cv-header .periodLabel {
	padding: 0.4em 0.6em;
}

.cv-header button {
	box-sizing: border-box;
	line-height: 1em;
	font-size: 1em;
	border-width: 1px;
}
</style>
