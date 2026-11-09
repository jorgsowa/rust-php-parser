===source===
<?php use;
===errors===
expected identifier, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting identifier (T_STRING) or function (T_FUNCTION) or const (T_CONST) or \\ (T_NS_SEPARATOR) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [],
                "kind": "Error",
                "span": {
                  "start": 9,
                  "end": 9
                }
              },
              "alias": null,
              "span": {
                "start": 9,
                "end": 9
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 10
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 10
  }
}
