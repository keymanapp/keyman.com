(function initializeSentry() {
  if(!window.Sentry) {
    // Sentry scripts may have been blocked by client browser;
    // we won't be reporting errors to Sentry, but we don't
    // want to throw other errors
    return;
  }

  //
  // Initialize Sentry for this site
  //

  Sentry.init({
    dsn: "https://44d5544d7c45466ba1928b9196faf67e@o1005580.ingest.us.sentry.io/5983516",
    integrations: [
      Sentry.httpClientIntegration(),
      Sentry.captureConsoleIntegration({
        levels: ['error', 'warning']
      })
    ],
    environment: sentryEnvironment.tier,
  });

  //
  // Capture resource load errors
  // per https://docs.sentry.io/platforms/javascript/troubleshooting/#capturing-resource-404s
  //

  window.addEventListener(
    "error",
    (event) => {
      if (!event.target) return;

      console.log('img fail');

      if (event.target.tagName === "IMG") {
        Sentry.captureException(
          new Error(`Failed to load image: ${event.target.src}`),
        );
      } else if (event.target.tagName === "LINK" && event.target.rel === "stylesheet") {
        Sentry.captureException(
          new Error(`Failed to load external stylesheet: ${event.target.href}`),
        );
      } else if (event.target.tagName === "SCRIPT") {
        Sentry.captureException(
          new Error(`Failed to load external script: ${event.target.src}`),
        );
      }
    },
    true, // useCapture - necessary for resource loading errors
  );
  console.log(`Sentry initialization complete: tier=${sentryEnvironment.tier}`);
})();
