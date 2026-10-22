===source===
<?php unset(1);
===errors===
Can't use this expression in write context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '1' (T_LNUMBER) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected integer "1" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 12,
              "end": 13
            }
          }
        ]
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
