===source===
<?php if }
===errors===
expected '(', found '}'
expected expression, found '}'
missing closing ')'
expected expression, found '}'
expected expression, found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}', expecting '(' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  Unmatched '}' in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": "Error",
            "span": {
              "start": 9,
              "end": 10
            }
          },
          "then_branch": {
            "kind": "Error",
            "span": {
              "start": 9,
              "end": 9
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 9
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 9,
        "end": 9
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 9
  }
}
