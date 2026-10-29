===source===
<?php (unset)$x;
===errors >=8.0===
The (unset) cast is no longer supported
===php_error >=8.0===
PHP Fatal error:  The (unset) cast is no longer supported in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Unset",
              {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 13,
                  "end": 15
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
