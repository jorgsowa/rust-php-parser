===source===
<?php if ($a): elseif 
===errors===
expected '(', found end of file
expected expression, found end of file
expected ')', found end of file
expected ':', found end of file
expected 'endif', found end of file
expected ';' after 'endif'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting '(' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected end of file, expecting "(" in Standard input code on line 1
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
          "else_branch": null,
          "uses_alternative": true
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
