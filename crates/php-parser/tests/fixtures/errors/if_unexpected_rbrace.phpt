===source===
<?php if }
===errors===
expected '(', found '}'
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
              "start": 8,
              "end": 8
            }
          },
          "then_branch": {
            "kind": "Error",
            "span": {
              "start": 8,
              "end": 8
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 8
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 8
  }
}
