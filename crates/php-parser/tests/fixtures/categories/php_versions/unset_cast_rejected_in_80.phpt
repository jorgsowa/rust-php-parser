===source===
<?php (unset)$x;
===errors >=8.0===
the (unset) cast is no longer supported
===php_error===
PHP Fatal error:  The (unset) cast is no longer supported in Standard input code on line 1
===ast >=8.0===
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
