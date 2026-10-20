===source===
<?php $a?->b(...);
===errors===
Cannot combine nullsafe operator with Closure creation
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 1
===php_error >=8.1===
PHP Fatal error:  Cannot combine nullsafe operator with Closure creation in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "NullsafeMethod": {
                  "object": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 6,
                      "end": 8
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "b"
                    },
                    "span": {
                      "start": 11,
                      "end": 12
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
