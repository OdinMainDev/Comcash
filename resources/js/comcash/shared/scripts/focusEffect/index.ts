import $ from 'jquery';
const activeStyles = [
    "bg-[linear-gradient(0deg,_rgba(30,30,30,0.6),_rgba(30,30,30,0.6)),_linear-gradient(0deg,_rgba(6,171,107,0.05),_rgba(6,171,107,0.05))]",
    "border-[#06AB6B]",
    "transition-all",
    "duration-300",
    "bg-[#2A2A2A]",
];

const defaultStyles = ["border-[#FFFFFF1A]/10", "bg-[#1B1B1B]"];

export function setupFocusEffects() {
    $("[data-focus-target]").each(function () {
        const $trigger = $(this);
        const targetSelector = $trigger.data("focus-target");
        const $target = $(targetSelector);

        if (!$target.length) return;

        const activate = () => {
            $target
                .removeClass(defaultStyles.join(" "))
                .addClass(activeStyles.join(" "));
        };

        const deactivate = () => {
            $target
                .removeClass(activeStyles.join(" "))
                .addClass(defaultStyles.join(" "));
        };

        $trigger.on("focus click", activate);
        $trigger.on("blur", deactivate);

        $(document).on("click.focusEffects", (e) => {
            const target = e.target;

            if (!(target instanceof HTMLElement)) return;

            if (
                !$trigger.is(target) &&
                $trigger.has(target).length === 0 &&
                !$target.is(target) &&
                $target.has(target).length === 0
            ) {
                deactivate();
            }
        });
    });
}
$(document).ready(() => {
    setupFocusEffects();
});
