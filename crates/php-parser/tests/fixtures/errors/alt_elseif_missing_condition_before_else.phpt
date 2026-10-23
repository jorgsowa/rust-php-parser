===source===
<?php
if ($a):
elseif else:
endif;
===errors===
expected '(', found 'else'
expected expression, found 'else'
expected ')', found 'else'
expected ':', found 'else'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'else' (T_ELSE), expecting '(' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "else", expecting "(" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 10,
              "end": 12
            }
          },
          "then_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 6,
              "end": 14
            }
          },
          "elseif_branches": [
            {
              "condition": {
                "kind": "Error",
                "span": {
                  "start": 21,
                  "end": 21
                }
              },
              "body": {
                "kind": {
                  "Block": []
                },
                "span": {
                  "start": 21,
                  "end": 21
                }
              },
              "span": {
                "start": 21,
                "end": 21
              }
            }
          ],
          "else_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 6,
              "end": 27
            }
          },
          "uses_alternative": true
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
