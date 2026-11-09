===source===
<?php foreach ($a as $k?->b => $v) {}
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
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          "key": {
            "kind": {
              "NullsafePropertyAccess": {
                "object": {
                  "kind": {
                    "Variable": "k"
                  },
                  "span": {
                    "start": 21,
                    "end": 23
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "b"
                  },
                  "span": {
                    "start": 26,
                    "end": 27
                  }
                }
              }
            },
            "span": {
              "start": 21,
              "end": 27
            }
          },
          "value": {
            "kind": {
              "Variable": "v"
            },
            "span": {
              "start": 31,
              "end": 33
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 35,
              "end": 37
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
