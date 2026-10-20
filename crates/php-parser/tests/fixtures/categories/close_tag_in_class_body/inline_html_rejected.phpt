===source===
<?php class A { const X = 1 ?>x<?php }
===errors===
expected class member, found inline HTML
===php_error <=8.2===
PHP Parse error:  syntax error, unexpected T_INLINE_HTML "x", expecting "function" or "const" in Standard input code on line 1
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected T_INLINE_HTML "x", expecting "function" in Standard input code on line 1
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
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 22,
                      "end": 23
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 30
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
