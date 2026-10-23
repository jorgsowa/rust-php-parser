===source===
<?php try {} finally 
===errors===
expected '{', found end of file
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
          "finally": []
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
