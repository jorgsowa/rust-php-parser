===source===
<?php
try {
} catch (static) {
}
===errors <=7.4===
Bad class name in the catch statement
'non-capturing catch' requires PHP 8.0 or higher
===errors >=8.0===
Bad class name in the catch statement
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC), expecting identifier (T_STRING) or namespace (T_NAMESPACE) or \\ (T_NS_SEPARATOR) in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Bad class name in the catch statement in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "static"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 21,
                    "end": 27
                  }
                }
              ],
              "var": null,
              "body": [],
              "span": {
                "start": 14,
                "end": 32
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
