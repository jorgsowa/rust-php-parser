===source===
<?php try 
===errors===
expected '{', found end of file
expected catch or finally clause, found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting '{' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected end of file, expecting "{" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 9
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 9
  }
}
