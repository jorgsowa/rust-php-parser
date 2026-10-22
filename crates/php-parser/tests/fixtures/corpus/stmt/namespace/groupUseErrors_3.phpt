===source===
<?php
// Extra NS separator
use Foo\{\Bar};
===errors===
expected non-fully-qualified name in group use, found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '\' (T_NS_SEPARATOR), expecting identifier (T_STRING) or function (T_FUNCTION) or const (T_CONST) in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected fully qualified name "\Bar", expecting identifier or namespaced name or "function" or "const" in Standard input code on line 3
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
                "parts": [
                  "Foo",
                  "Bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 32,
                  "end": 41
                }
              },
              "alias": null,
              "span": {
                "start": 37,
                "end": 41
              }
            }
          ]
        }
      },
      "span": {
        "start": 28,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
