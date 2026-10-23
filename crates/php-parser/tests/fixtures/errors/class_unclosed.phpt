===source===
<?php class Test {
===errors===
missing closing '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting function (T_FUNCTION) or const (T_CONST) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  Unclosed '{' in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Test",
            "span": {
              "start": 12,
              "end": 16
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
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
