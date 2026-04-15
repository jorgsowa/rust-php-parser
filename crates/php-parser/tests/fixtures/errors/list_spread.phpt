===source===
<?php list(...$x) = $arr;
===errors===
expected expression
expected ')', found '...'
expected ';' after expression
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": "Error",
                  "span": {
                    "start": 11,
                    "end": 14
                  }
                },
                "unpack": false,
                "span": {
                  "start": 11,
                  "end": 14
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 11
          }
        }
      },
      "span": {
        "start": 6,
        "end": 11
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 11,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
===php_error===
PHP Fatal error:  Spread operator is not supported in assignments in Standard input code on line 1
Stack trace:
#0 {main}
