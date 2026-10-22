===source===
<?php function f() 
===errors===
expected '{', found end of file
missing closing '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting '{' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected end of file, expecting "{" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
