===source===
<?php class function while;
===errors===
Cannot use "function" as a class name as it is reserved
expected '{', found 'while'
expected class member, found 'while'
expected '}', found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'function' (T_FUNCTION), expecting identifier (T_STRING) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "function", expecting identifier in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "function",
            "span": {
              "start": 12,
              "end": 20
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
