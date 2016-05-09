var ActionBar,
    DataActionBar,
    Menu,
    Slider,
    BottomNavigation,
    BottomSheet,
    Snackbar,
    View,
    DialogBox,
    BlackTrans,
    Loading,
    Input,
    Card,
    Chip,
	Tooltip;
Components = {
    ready: function() {
        App.log("\tInitializing components...");
        BlackTrans.ready();
        ActionBar.ready();
        Menu.ready();
        Slider.ready();
        DataActionBar.ready();
        BottomNavigation.ready();
        BottomSheet.ready();
        View.ready();
        Snackbar.ready();
        DialogBox.ready();
        Loading.ready();
        Input.ready();
        Card.ready();
        Chip.ready();
		Tooltip.ready();
        App.log("\tComponents initialized.");
    }
}