===source===
<?php class function while;
===errors===
expected '{', found 'while'
expected class member, found 'while'
expected '}', found end of file
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "function",
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
===php_error===
PHP Parse error:  syntax error, unexpected token "function", expecting identifier in Standard input code on line 1
