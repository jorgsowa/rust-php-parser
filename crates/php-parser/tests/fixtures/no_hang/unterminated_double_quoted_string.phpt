===source===
<?php $x = "
===errors===
unterminated string literal
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting variable (T_VARIABLE) or quoted-string and whitespace (T_ENCAPSED_AND_WHITESPACE) or ${ (T_DOLLAR_OPEN_CURLY_BRACES) or {$ (T_CURLY_OPEN) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected end of file, expecting variable or string content or "${" or "{$" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": ""
                },
                "span": {
                  "start": 11,
                  "end": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 12
  }
}
