===source===
<?php if (true):
    echo 1;
} endif;
===errors===
expected expression, found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}', expecting elseif (T_ELSEIF) or else (T_ELSE) or endif (T_ENDIF) in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  Unmatched '}' in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 10,
              "end": 14
            }
          },
          "then_branch": {
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
                          "start": 26,
                          "end": 27
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 21,
                    "end": 28
                  }
                },
                {
                  "kind": "Error",
                  "span": {
                    "start": 28,
                    "end": 28
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 30
            }
          },
          "elseif_branches": [],
          "else_branch": null,
          "uses_alternative": true
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
