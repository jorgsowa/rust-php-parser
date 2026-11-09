===source===
<?php $a?->b(...);
===errors <=7.4===
'nullsafe operator (?->)' requires PHP 8.0 or higher
'first-class callable syntax' requires PHP 8.1 or higher
Cannot combine nullsafe operator with Closure creation
===errors 8.0===
'first-class callable syntax' requires PHP 8.1 or higher
Cannot combine nullsafe operator with Closure creation
===errors >=8.1===
Cannot combine nullsafe operator with Closure creation
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 1
===php_error 8.0===
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
