===source===
<?php
function f() {
    namespace C;
}
===errors===
namespace declarations can only be used at the outermost scope
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'C' (T_STRING), expecting \\ (T_NS_SEPARATOR) in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "namespace" in Standard input code on line 3
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
          "body": [
            {
              "kind": {
                "Namespace": {
                  "name": {
                    "parts": [
                      "C"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 35,
                      "end": 36
                    }
                  },
                  "body": "Simple"
                }
              },
              "span": {
                "start": 25,
                "end": 37
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
