===source===
<?php
function foo() {
    $bar->
}
===errors===
expected member name, found '}'
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}', expecting identifier (T_STRING) or variable (T_VARIABLE) or '{' or '$' in Standard input code on line 4
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "}", expecting identifier or variable or "{" or "$" in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 15,
              "end": 18
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "PropertyAccess": {
                      "object": {
                        "kind": {
                          "Variable": "bar"
                        },
                        "span": {
                          "start": 27,
                          "end": 31
                        }
                      },
                      "property": {
                        "kind": "Error",
                        "span": {
                          "start": 34,
                          "end": 35
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 27,
                    "end": 35
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 33
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
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
