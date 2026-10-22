===source===
<?php switch ($a) 
===errors===
expected '{', found end of file
expected '}', found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting ':' or '{' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected end of file, expecting ":" or "{" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 14,
              "end": 16
            }
          },
          "cases": []
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
