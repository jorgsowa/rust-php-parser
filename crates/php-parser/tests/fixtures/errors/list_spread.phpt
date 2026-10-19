===source===
<?php list(...$x) = $arr;
===errors===
expected expression
expected ')', found '...'
list() can only be used as an assignment or foreach target
expected ';' after expression
expected expression
===php_error===
PHP Fatal error:  Spread operator is not supported in assignments in Standard input code on line 1
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
                "kind": {
                  "Value": {
                    "kind": "Error",
                    "span": {
                      "start": 11,
                      "end": 14
                    }
                  }
                },
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
