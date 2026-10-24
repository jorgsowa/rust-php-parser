===source===
<?php class A { readonly function foo() {} }
===errors <=8.0===
'readonly properties' requires PHP 8.1 or higher
Cannot use 'readonly' as method modifier
===errors 8.1-8.2===
Cannot use 'readonly' as method modifier
===errors >=8.3===
Cannot use the readonly modifier on a method
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'readonly' (T_STRING), expecting function (T_FUNCTION) or const (T_CONST) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "readonly", expecting "function" or "const" in Standard input code on line 1
===php_error 8.1-8.2===
PHP Fatal error:  Cannot use 'readonly' as method modifier in Standard input code on line 1
===php_error >=8.3===
PHP Fatal error:  Cannot use the readonly modifier on a method in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "foo",
                    "span": {
                      "start": 34,
                      "end": 37
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 42
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
