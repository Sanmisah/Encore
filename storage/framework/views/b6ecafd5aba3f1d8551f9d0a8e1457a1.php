<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['disabled' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['disabled' => false]); ?>
<?php foreach (array_filter((['disabled' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="flex">
    <div class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">https://</div>
    <!-- <input type="text" <?php echo e($disabled ? 'disabled' : ''); ?> class="form-input ltr:rounded-l-none rtl:rounded-r-none" /> -->
    <input type="text" <?php echo e($disabled ? 'disabled' : ''); ?> <?php echo $attributes->merge(['class' => 'form-input ltr:rounded-l-none rtl:rounded-r-none']); ?> />
</div><?php /**PATH C:\Users\HP\Project\TeamPulse\resources\views/components/url-input.blade.php ENDPATH**/ ?>