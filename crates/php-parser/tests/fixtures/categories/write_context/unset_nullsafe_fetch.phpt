===source===
<?php unset($a?->b);
===errors <=7.4===
'nullsafe operator (?->)' requires PHP 8.0 or higher
Can't use nullsafe operator in write context
===errors >=8.0===
Can't use nullsafe operator in write context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?', expecting :: (T_PAAMAYIM_NEKUDOTAYIM) in Standard input code on line 1
===php_error >=8.0===
PHP Fatal error:  Can't use nullsafe operator in write context in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "NullsafePropertyAccess": {
                "object": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 12,
                    "end": 14
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "b"
                  },
                  "span": {
                    "start": 17,
                    "end": 18
                  }
                }
              }
            },
            "span": {
              "start": 12,
              "end": 18
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
