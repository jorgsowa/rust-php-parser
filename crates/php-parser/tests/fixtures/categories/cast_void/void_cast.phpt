===source===
<?php (void)$x;
===errors <=8.4===
'void cast' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '$x' (T_VARIABLE) in Standard input code on line 1
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected variable "$x" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 12,
                  "end": 14
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
