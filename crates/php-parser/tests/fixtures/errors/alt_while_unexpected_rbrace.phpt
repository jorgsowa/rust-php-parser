===source===
<?php while (true):
    echo 1;
} endwhile;
===errors===
expected expression, found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  Unmatched '}' in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 13,
              "end": 17
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 29,
                          "end": 30
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 24,
                    "end": 31
                  }
                },
                {
                  "kind": "Error",
                  "span": {
                    "start": 31,
                    "end": 31
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 43
            }
          },
          "uses_alternative": true
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
