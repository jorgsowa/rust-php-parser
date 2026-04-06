mod common;
use common::{assert_no_errors, to_json};

fn parse_php(source: &'static str) -> php_rs_parser::ParseResult<'static, 'static> {
    // Leak arena and source for test simplicity — process exits after test run anyway
    let arena: &'static bumpalo::Bump = Box::leak(Box::new(bumpalo::Bump::new()));
    php_rs_parser::parse(arena, source)
}

macro_rules! fixture_test {
    ($name:ident, $file:expr) => {
        #[test]
        fn $name() {
            let (_, source) = common::parse_fixture(include_str!(concat!("fixtures/", $file)));
            let result = parse_php(source);
            assert_no_errors(&result);
            insta::assert_snapshot!(to_json(&result.program));
        }
    };
    ($name:ident, $file:expr, errors) => {
        #[test]
        fn $name() {
            let (_, source) = common::parse_fixture(include_str!(concat!("fixtures/", $file)));
            let result = parse_php(source);
            assert!(
                !result.errors.is_empty(),
                "expected parse errors but found none"
            );
            insta::assert_snapshot!(to_json(&result.program));
        }
    };
}

// =============================================================================
// Corpus fixtures adapted from nikic/PHP-Parser (error handling, expr, scalar, stmt)
// Fixture files live in tests/fixtures/corpus/
// =============================================================================

// error handling
fixture_test!(
    errorhandling_eoferror_1,
    "corpus/errorHandling/eofError_1.phpt",
    errors
);
fixture_test!(
    errorhandling_eoferror_2,
    "corpus/errorHandling/eofError_2.phpt",
    errors
);
fixture_test!(
    errorhandling_lexererrors_1,
    "corpus/errorHandling/lexerErrors_1.phpt"
);
fixture_test!(
    errorhandling_lexererrors_5,
    "corpus/errorHandling/lexerErrors_5.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_1,
    "corpus/errorHandling/recovery_1.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_2,
    "corpus/errorHandling/recovery_2.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_3,
    "corpus/errorHandling/recovery_3.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_4,
    "corpus/errorHandling/recovery_4.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_5,
    "corpus/errorHandling/recovery_5.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_6,
    "corpus/errorHandling/recovery_6.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_7,
    "corpus/errorHandling/recovery_7.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_8,
    "corpus/errorHandling/recovery_8.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_9,
    "corpus/errorHandling/recovery_9.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_10,
    "corpus/errorHandling/recovery_10.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_11,
    "corpus/errorHandling/recovery_11.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_12,
    "corpus/errorHandling/recovery_12.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_13,
    "corpus/errorHandling/recovery_13.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_14,
    "corpus/errorHandling/recovery_14.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_15,
    "corpus/errorHandling/recovery_15.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_16,
    "corpus/errorHandling/recovery_16.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_17,
    "corpus/errorHandling/recovery_17.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_18,
    "corpus/errorHandling/recovery_18.phpt"
);
fixture_test!(
    errorhandling_recovery_19,
    "corpus/errorHandling/recovery_19.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_20,
    "corpus/errorHandling/recovery_20.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_21,
    "corpus/errorHandling/recovery_21.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_22,
    "corpus/errorHandling/recovery_22.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_23,
    "corpus/errorHandling/recovery_23.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_24,
    "corpus/errorHandling/recovery_24.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_25,
    "corpus/errorHandling/recovery_25.phpt",
    errors
);
fixture_test!(
    errorhandling_recovery_26,
    "corpus/errorHandling/recovery_26.phpt",
    errors
);

// expr
fixture_test!(
    expr_alternative_array_syntax_1,
    "corpus/expr/alternative_array_syntax_1.phpt"
);
fixture_test!(
    expr_alternative_array_syntax_2,
    "corpus/expr/alternative_array_syntax_2.phpt"
);
fixture_test!(expr_arraydef, "corpus/expr/arrayDef.phpt");
fixture_test!(
    expr_arraydestructuring,
    "corpus/expr/arrayDestructuring.phpt"
);
fixture_test!(
    expr_arrayemptyelemens,
    "corpus/expr/arrayEmptyElemens.phpt",
    errors
);
fixture_test!(expr_arrayspread, "corpus/expr/arraySpread.phpt");
fixture_test!(expr_arrow_function, "corpus/expr/arrow_function.phpt");
fixture_test!(expr_assign, "corpus/expr/assign.phpt");
fixture_test!(expr_assignnewbyref_1, "corpus/expr/assignNewByRef_1.phpt");
fixture_test!(expr_assignnewbyref_2, "corpus/expr/assignNewByRef_2.phpt");
fixture_test!(expr_cast, "corpus/expr/cast.phpt", errors);
fixture_test!(expr_clone, "corpus/expr/clone.phpt");
fixture_test!(expr_closure, "corpus/expr/closure.phpt");
fixture_test!(
    expr_closure_use_trailing_comma,
    "corpus/expr/closure_use_trailing_comma.phpt"
);
fixture_test!(expr_comparison, "corpus/expr/comparison.phpt");
fixture_test!(
    expr_concatprecedence_1,
    "corpus/expr/concatPrecedence_1.phpt"
);
fixture_test!(
    expr_concatprecedence_2,
    "corpus/expr/concatPrecedence_2.phpt"
);
fixture_test!(expr_constant_expr, "corpus/expr/constant_expr.phpt");
fixture_test!(expr_dynamicclassconst, "corpus/expr/dynamicClassConst.phpt");
fixture_test!(expr_errorsuppress, "corpus/expr/errorSuppress.phpt");
fixture_test!(expr_exit, "corpus/expr/exit.phpt");
fixture_test!(expr_exprinisset, "corpus/expr/exprInIsset.phpt");
fixture_test!(expr_exprinlist, "corpus/expr/exprInList.phpt");
fixture_test!(expr_fetchandcall_args, "corpus/expr/fetchAndCall/args.phpt");
fixture_test!(
    expr_fetchandcall_constfetch,
    "corpus/expr/fetchAndCall/constFetch.phpt"
);
fixture_test!(
    expr_fetchandcall_constantderef,
    "corpus/expr/fetchAndCall/constantDeref.phpt"
);
fixture_test!(
    expr_fetchandcall_funccall,
    "corpus/expr/fetchAndCall/funcCall.phpt"
);
fixture_test!(
    expr_fetchandcall_namedargs,
    "corpus/expr/fetchAndCall/namedArgs.phpt"
);
fixture_test!(
    expr_fetchandcall_newderef,
    "corpus/expr/fetchAndCall/newDeref.phpt"
);
fixture_test!(
    expr_fetchandcall_objectaccess,
    "corpus/expr/fetchAndCall/objectAccess.phpt"
);
fixture_test!(
    expr_fetchandcall_simplearrayaccess,
    "corpus/expr/fetchAndCall/simpleArrayAccess.phpt"
);
fixture_test!(
    expr_fetchandcall_staticcall,
    "corpus/expr/fetchAndCall/staticCall.phpt"
);
fixture_test!(
    expr_fetchandcall_staticpropertyfetch,
    "corpus/expr/fetchAndCall/staticPropertyFetch.phpt"
);
fixture_test!(
    expr_firstclasscallables,
    "corpus/expr/firstClassCallables.phpt"
);
fixture_test!(expr_includeandeval, "corpus/expr/includeAndEval.phpt");
fixture_test!(expr_issetandempty, "corpus/expr/issetAndEmpty.phpt");
fixture_test!(
    expr_keywordsinnamespacedname,
    "corpus/expr/keywordsInNamespacedName.phpt"
);
fixture_test!(expr_listreferences, "corpus/expr/listReferences.phpt");
fixture_test!(expr_listwithkeys, "corpus/expr/listWithKeys.phpt");
fixture_test!(expr_logic, "corpus/expr/logic.phpt");
fixture_test!(expr_match_1, "corpus/expr/match_1.phpt");
fixture_test!(expr_match_2, "corpus/expr/match_2.phpt");
fixture_test!(expr_match_3, "corpus/expr/match_3.phpt");
fixture_test!(expr_match_4, "corpus/expr/match_4.phpt");
fixture_test!(expr_match_5, "corpus/expr/match_5.phpt");
fixture_test!(expr_math, "corpus/expr/math.phpt");
fixture_test!(expr_new, "corpus/expr/new.phpt");
fixture_test!(expr_newderef, "corpus/expr/newDeref.phpt");
fixture_test!(
    expr_newwithoutclass,
    "corpus/expr/newWithoutClass.phpt",
    errors
);
fixture_test!(expr_nullsafe, "corpus/expr/nullsafe.phpt");
fixture_test!(expr_pipe, "corpus/expr/pipe.phpt");
fixture_test!(expr_print, "corpus/expr/print.phpt");
fixture_test!(expr_shellexec, "corpus/expr/shellExec.phpt");
fixture_test!(
    expr_ternaryandcoalesce,
    "corpus/expr/ternaryAndCoalesce.phpt"
);
fixture_test!(expr_throw, "corpus/expr/throw.phpt");
fixture_test!(expr_trailingcommas, "corpus/expr/trailingCommas.phpt");
fixture_test!(expr_uvs_constderef, "corpus/expr/uvs/constDeref.phpt");
fixture_test!(
    expr_uvs_globalnonsimplevarerror,
    "corpus/expr/uvs/globalNonSimpleVarError.phpt",
    errors
);
fixture_test!(expr_uvs_indirectcall, "corpus/expr/uvs/indirectCall.phpt");
fixture_test!(expr_uvs_isset, "corpus/expr/uvs/isset.phpt");
fixture_test!(expr_uvs_misc, "corpus/expr/uvs/misc.phpt");
fixture_test!(expr_uvs_new, "corpus/expr/uvs/new.phpt");
fixture_test!(
    expr_uvs_newinstanceofexpr,
    "corpus/expr/uvs/newInstanceofExpr.phpt"
);
fixture_test!(
    expr_uvs_staticproperty,
    "corpus/expr/uvs/staticProperty.phpt"
);
fixture_test!(expr_varvarpos, "corpus/expr/varVarPos.phpt");
fixture_test!(expr_variable, "corpus/expr/variable.phpt");

// misc
fixture_test!(blockcomments, "corpus/blockComments.phpt");
fixture_test!(commentatendofclass, "corpus/commentAtEndOfClass.phpt");
fixture_test!(comments_1, "corpus/comments_1.phpt");
fixture_test!(comments_2, "corpus/comments_2.phpt");
fixture_test!(comments_3, "corpus/comments_3.phpt");
fixture_test!(emptyfile, "corpus/emptyFile.phpt");
fixture_test!(formattingattributes, "corpus/formattingAttributes.phpt");
fixture_test!(noppositions_1, "corpus/nopPositions_1.phpt");
fixture_test!(noppositions_2, "corpus/nopPositions_2.phpt");
fixture_test!(semireserved, "corpus/semiReserved.phpt");

// scalar
fixture_test!(scalar_constantstring, "corpus/scalar/constantString.phpt");
fixture_test!(scalar_docstring, "corpus/scalar/docString.phpt");
fixture_test!(scalar_encapsedstring, "corpus/scalar/encapsedString.phpt");
fixture_test!(scalar_explicitoctal, "corpus/scalar/explicitOctal.phpt");
fixture_test!(scalar_float, "corpus/scalar/float.phpt");
fixture_test!(scalar_invalidoctal_1, "corpus/scalar/invalidOctal_1.phpt");
fixture_test!(scalar_invalidoctal_2, "corpus/scalar/invalidOctal_2.phpt");
fixture_test!(scalar_magicconst, "corpus/scalar/magicConst.phpt");
fixture_test!(
    scalar_numberseparators,
    "corpus/scalar/numberSeparators.phpt",
    errors
);
fixture_test!(scalar_unicodeescape_1, "corpus/scalar/unicodeEscape_1.phpt");
fixture_test!(scalar_unicodeescape_2, "corpus/scalar/unicodeEscape_2.phpt");
fixture_test!(scalar_unicodeescape_3, "corpus/scalar/unicodeEscape_3.phpt");

// stmt
fixture_test!(stmt_attributes, "corpus/stmt/attributes.phpt");
fixture_test!(
    stmt_blocklessstatement,
    "corpus/stmt/blocklessStatement.phpt"
);
fixture_test!(stmt_class_abstract, "corpus/stmt/class/abstract.phpt");
fixture_test!(stmt_class_anonymous, "corpus/stmt/class/anonymous.phpt");
fixture_test!(
    stmt_class_asymmetric_visibility_1,
    "corpus/stmt/class/asymmetric_visibility_1.phpt"
);
fixture_test!(
    stmt_class_asymmetric_visibility_2,
    "corpus/stmt/class/asymmetric_visibility_2.phpt"
);
fixture_test!(
    stmt_class_class_position_1,
    "corpus/stmt/class/class_position_1.phpt"
);
fixture_test!(
    stmt_class_class_position_2,
    "corpus/stmt/class/class_position_2.phpt"
);
fixture_test!(
    stmt_class_class_position_3,
    "corpus/stmt/class/class_position_3.phpt"
);
fixture_test!(stmt_class_conditional, "corpus/stmt/class/conditional.phpt");
fixture_test!(
    stmt_class_constmodifiererrors_1,
    "corpus/stmt/class/constModifierErrors_1.phpt",
    errors
);
fixture_test!(
    stmt_class_constmodifiererrors_2,
    "corpus/stmt/class/constModifierErrors_2.phpt",
    errors
);
fixture_test!(
    stmt_class_constmodifiererrors_3,
    "corpus/stmt/class/constModifierErrors_3.phpt",
    errors
);
fixture_test!(
    stmt_class_constmodifiererrors_4,
    "corpus/stmt/class/constModifierErrors_4.phpt",
    errors
);
fixture_test!(
    stmt_class_constmodifiers,
    "corpus/stmt/class/constModifiers.phpt"
);
fixture_test!(stmt_class_enum, "corpus/stmt/class/enum.phpt", errors);
fixture_test!(
    stmt_class_enum_with_string,
    "corpus/stmt/class/enum_with_string.phpt"
);
fixture_test!(stmt_class_final, "corpus/stmt/class/final.phpt");
fixture_test!(
    stmt_class_implicitpublic,
    "corpus/stmt/class/implicitPublic.phpt"
);
fixture_test!(stmt_class_interface, "corpus/stmt/class/interface.phpt");
fixture_test!(
    stmt_class_modifier_error_1,
    "corpus/stmt/class/modifier_error_1.phpt",
    errors
);
fixture_test!(
    stmt_class_modifier_error_2,
    "corpus/stmt/class/modifier_error_2.phpt",
    errors
);
fixture_test!(
    stmt_class_modifier_error_3,
    "corpus/stmt/class/modifier_error_3.phpt",
    errors
);
fixture_test!(
    stmt_class_modifier_error_4,
    "corpus/stmt/class/modifier_error_4.phpt",
    errors
);
fixture_test!(
    stmt_class_modifier_error_5,
    "corpus/stmt/class/modifier_error_5.phpt",
    errors
);
fixture_test!(
    stmt_class_modifier_error_6,
    "corpus/stmt/class/modifier_error_6.phpt",
    errors
);
fixture_test!(
    stmt_class_modifier_error_7,
    "corpus/stmt/class/modifier_error_7.phpt",
    errors
);
fixture_test!(
    stmt_class_modifier_error_8,
    "corpus/stmt/class/modifier_error_8.phpt",
    errors
);
fixture_test!(stmt_class_name_1, "corpus/stmt/class/name_1.phpt", errors);
fixture_test!(stmt_class_name_2, "corpus/stmt/class/name_2.phpt", errors);
fixture_test!(stmt_class_name_3, "corpus/stmt/class/name_3.phpt", errors);
fixture_test!(stmt_class_name_4, "corpus/stmt/class/name_4.phpt", errors);
fixture_test!(stmt_class_name_5, "corpus/stmt/class/name_5.phpt", errors);
fixture_test!(stmt_class_name_6, "corpus/stmt/class/name_6.phpt", errors);
fixture_test!(stmt_class_name_7, "corpus/stmt/class/name_7.phpt", errors);
fixture_test!(stmt_class_name_8, "corpus/stmt/class/name_8.phpt", errors);
fixture_test!(stmt_class_name_9, "corpus/stmt/class/name_9.phpt", errors);
fixture_test!(stmt_class_name_10, "corpus/stmt/class/name_10.phpt", errors);
fixture_test!(stmt_class_name_11, "corpus/stmt/class/name_11.phpt", errors);
fixture_test!(stmt_class_name_12, "corpus/stmt/class/name_12.phpt", errors);
fixture_test!(stmt_class_name_13, "corpus/stmt/class/name_13.phpt", errors);
fixture_test!(stmt_class_name_14, "corpus/stmt/class/name_14.phpt", errors);
fixture_test!(stmt_class_name_15, "corpus/stmt/class/name_15.phpt", errors);
fixture_test!(
    stmt_class_php4style,
    "corpus/stmt/class/php4Style.phpt",
    errors
);
fixture_test!(
    stmt_class_propertytypes,
    "corpus/stmt/class/propertyTypes.phpt"
);
fixture_test!(
    stmt_class_property_hooks_1,
    "corpus/stmt/class/property_hooks_1.phpt"
);
fixture_test!(
    stmt_class_property_hooks_2,
    "corpus/stmt/class/property_hooks_2.phpt"
);
fixture_test!(
    stmt_class_property_hooks_3,
    "corpus/stmt/class/property_hooks_3.phpt"
);
fixture_test!(
    stmt_class_property_hooks_4,
    "corpus/stmt/class/property_hooks_4.phpt",
    errors
);
fixture_test!(
    stmt_class_property_hooks_5,
    "corpus/stmt/class/property_hooks_5.phpt",
    errors
);
fixture_test!(
    stmt_class_property_hooks_6,
    "corpus/stmt/class/property_hooks_6.phpt",
    errors
);
fixture_test!(
    stmt_class_property_hooks_7,
    "corpus/stmt/class/property_hooks_7.phpt",
    errors
);
fixture_test!(
    stmt_class_property_modifiers,
    "corpus/stmt/class/property_modifiers.phpt"
);
fixture_test!(
    stmt_class_property_promotion,
    "corpus/stmt/class/property_promotion.phpt"
);
fixture_test!(stmt_class_readonly_1, "corpus/stmt/class/readonly_1.phpt");
fixture_test!(stmt_class_readonly_2, "corpus/stmt/class/readonly_2.phpt");
fixture_test!(
    stmt_class_readonlyanonyous,
    "corpus/stmt/class/readonlyAnonyous.phpt"
);
fixture_test!(
    stmt_class_readonlyasclassname_1,
    "corpus/stmt/class/readonlyAsClassName_1.phpt",
    errors
);
fixture_test!(
    stmt_class_readonlyasclassname_2,
    "corpus/stmt/class/readonlyAsClassName_2.phpt",
    errors
);
fixture_test!(
    stmt_class_readonlymethod,
    "corpus/stmt/class/readonlyMethod.phpt"
);
fixture_test!(
    stmt_class_shortechoasidentifier,
    "corpus/stmt/class/shortEchoAsIdentifier.phpt",
    errors
);
fixture_test!(stmt_class_simple, "corpus/stmt/class/simple.phpt");
fixture_test!(
    stmt_class_staticmethod_1,
    "corpus/stmt/class/staticMethod_1.phpt"
);
fixture_test!(
    stmt_class_staticmethod_2,
    "corpus/stmt/class/staticMethod_2.phpt"
);
fixture_test!(
    stmt_class_staticmethod_3,
    "corpus/stmt/class/staticMethod_3.phpt"
);
fixture_test!(
    stmt_class_staticmethod_4,
    "corpus/stmt/class/staticMethod_4.phpt"
);
fixture_test!(
    stmt_class_staticmethod_5,
    "corpus/stmt/class/staticMethod_5.phpt"
);
fixture_test!(
    stmt_class_staticmethod_6,
    "corpus/stmt/class/staticMethod_6.phpt"
);
fixture_test!(stmt_class_statictype, "corpus/stmt/class/staticType.phpt");
fixture_test!(stmt_class_trait, "corpus/stmt/class/trait.phpt");
fixture_test!(
    stmt_class_typedconstants,
    "corpus/stmt/class/typedConstants.phpt"
);
fixture_test!(stmt_const, "corpus/stmt/const.phpt", errors);
fixture_test!(stmt_controlflow, "corpus/stmt/controlFlow.phpt");
fixture_test!(stmt_declare, "corpus/stmt/declare.phpt");
fixture_test!(stmt_echo, "corpus/stmt/echo.phpt");
fixture_test!(
    stmt_function_builtintypedeclarations,
    "corpus/stmt/function/builtinTypeDeclarations.phpt"
);
fixture_test!(stmt_function_byref, "corpus/stmt/function/byRef.phpt");
fixture_test!(
    stmt_function_clone_function,
    "corpus/stmt/function/clone_function.phpt"
);
fixture_test!(
    stmt_function_conditional,
    "corpus/stmt/function/conditional.phpt"
);
fixture_test!(
    stmt_function_defaultvalues,
    "corpus/stmt/function/defaultValues.phpt"
);
fixture_test!(
    stmt_function_disjointnormalformtypes,
    "corpus/stmt/function/disjointNormalFormTypes.phpt"
);
fixture_test!(
    stmt_function_exit_die_function,
    "corpus/stmt/function/exit_die_function.phpt"
);
fixture_test!(
    stmt_function_intersectiontypes,
    "corpus/stmt/function/intersectionTypes.phpt"
);
fixture_test!(
    stmt_function_nevertype,
    "corpus/stmt/function/neverType.phpt"
);
fixture_test!(
    stmt_function_nullfalsetruetypes_1,
    "corpus/stmt/function/nullFalseTrueTypes_1.phpt"
);
fixture_test!(
    stmt_function_nullfalsetruetypes_2,
    "corpus/stmt/function/nullFalseTrueTypes_2.phpt"
);
fixture_test!(
    stmt_function_nullabletypes,
    "corpus/stmt/function/nullableTypes.phpt"
);
fixture_test!(
    stmt_function_parameters_trailing_comma_1,
    "corpus/stmt/function/parameters_trailing_comma_1.phpt"
);
fixture_test!(
    stmt_function_parameters_trailing_comma_2,
    "corpus/stmt/function/parameters_trailing_comma_2.phpt"
);
fixture_test!(
    stmt_function_parameters_trailing_comma_3,
    "corpus/stmt/function/parameters_trailing_comma_3.phpt"
);
fixture_test!(
    stmt_function_readonlyfunction,
    "corpus/stmt/function/readonlyFunction.phpt"
);
fixture_test!(
    stmt_function_returntypes,
    "corpus/stmt/function/returnTypes.phpt"
);
fixture_test!(
    stmt_function_specialvars,
    "corpus/stmt/function/specialVars.phpt"
);
fixture_test!(
    stmt_function_typedeclarations,
    "corpus/stmt/function/typeDeclarations.phpt"
);
fixture_test!(
    stmt_function_typeversions_1,
    "corpus/stmt/function/typeVersions_1.phpt"
);
fixture_test!(
    stmt_function_typeversions_2,
    "corpus/stmt/function/typeVersions_2.phpt"
);
fixture_test!(
    stmt_function_typeversions_3,
    "corpus/stmt/function/typeVersions_3.phpt"
);
fixture_test!(
    stmt_function_typeversions_4,
    "corpus/stmt/function/typeVersions_4.phpt"
);
fixture_test!(
    stmt_function_typeversions_5,
    "corpus/stmt/function/typeVersions_5.phpt"
);
fixture_test!(
    stmt_function_typeversions_6,
    "corpus/stmt/function/typeVersions_6.phpt"
);
fixture_test!(
    stmt_function_uniontypes,
    "corpus/stmt/function/unionTypes.phpt"
);
fixture_test!(stmt_function_variadic, "corpus/stmt/function/variadic.phpt");
fixture_test!(
    stmt_function_variadicdefaultvalue,
    "corpus/stmt/function/variadicDefaultValue.phpt"
);
fixture_test!(stmt_generator_basic, "corpus/stmt/generator/basic.phpt");
fixture_test!(
    stmt_generator_yieldprecedence,
    "corpus/stmt/generator/yieldPrecedence.phpt"
);
fixture_test!(
    stmt_generator_yieldunaryprecedence,
    "corpus/stmt/generator/yieldUnaryPrecedence.phpt"
);
fixture_test!(stmt_haltcompiler_1, "corpus/stmt/haltCompiler_1.phpt");
fixture_test!(stmt_haltcompiler_2, "corpus/stmt/haltCompiler_2.phpt");
fixture_test!(stmt_haltcompiler_3, "corpus/stmt/haltCompiler_3.phpt");
fixture_test!(
    stmt_haltcompilerinvalidsyntax,
    "corpus/stmt/haltCompilerInvalidSyntax.phpt",
    errors
);
fixture_test!(
    stmt_haltcompileroffset,
    "corpus/stmt/haltCompilerOffset.phpt"
);
fixture_test!(
    stmt_haltcompileroutermostscope,
    "corpus/stmt/haltCompilerOutermostScope.phpt",
    errors
);
fixture_test!(stmt_hashbang, "corpus/stmt/hashbang.phpt");
fixture_test!(stmt_if, "corpus/stmt/if.phpt");
fixture_test!(stmt_inlinehtml, "corpus/stmt/inlineHTML.phpt");
fixture_test!(stmt_loop_do, "corpus/stmt/loop/do.phpt");
fixture_test!(stmt_loop_for, "corpus/stmt/loop/for.phpt");
fixture_test!(stmt_loop_foreach, "corpus/stmt/loop/foreach.phpt");
fixture_test!(stmt_loop_while, "corpus/stmt/loop/while.phpt");
fixture_test!(stmt_multicatch, "corpus/stmt/multiCatch.phpt");
fixture_test!(stmt_namespace_alias, "corpus/stmt/namespace/alias.phpt");
fixture_test!(stmt_namespace_braced, "corpus/stmt/namespace/braced.phpt");
fixture_test!(
    stmt_namespace_commentafternamespace,
    "corpus/stmt/namespace/commentAfterNamespace.phpt"
);
fixture_test!(
    stmt_namespace_groupuse,
    "corpus/stmt/namespace/groupUse.phpt"
);
fixture_test!(
    stmt_namespace_groupuseerrors_1,
    "corpus/stmt/namespace/groupUseErrors_1.phpt",
    errors
);
fixture_test!(
    stmt_namespace_groupuseerrors_2,
    "corpus/stmt/namespace/groupUseErrors_2.phpt",
    errors
);
fixture_test!(
    stmt_namespace_groupuseerrors_3,
    "corpus/stmt/namespace/groupUseErrors_3.phpt",
    errors
);
fixture_test!(
    stmt_namespace_groupusepositions,
    "corpus/stmt/namespace/groupUsePositions.phpt"
);
fixture_test!(
    stmt_namespace_groupusetrailingcomma,
    "corpus/stmt/namespace/groupUseTrailingComma.phpt"
);
fixture_test!(
    stmt_namespace_invalidname_1,
    "corpus/stmt/namespace/invalidName_1.phpt",
    errors
);
fixture_test!(
    stmt_namespace_invalidname_2,
    "corpus/stmt/namespace/invalidName_2.phpt",
    errors
);
fixture_test!(
    stmt_namespace_invalidname_3,
    "corpus/stmt/namespace/invalidName_3.phpt",
    errors
);
fixture_test!(stmt_namespace_mix_1, "corpus/stmt/namespace/mix_1.phpt");
fixture_test!(stmt_namespace_mix_2, "corpus/stmt/namespace/mix_2.phpt");
fixture_test!(stmt_namespace_name, "corpus/stmt/namespace/name.phpt");
fixture_test!(stmt_namespace_nested, "corpus/stmt/namespace/nested.phpt");
fixture_test!(
    stmt_namespace_notbraced,
    "corpus/stmt/namespace/notBraced.phpt"
);
fixture_test!(
    stmt_namespace_nsafterhashbang,
    "corpus/stmt/namespace/nsAfterHashbang.phpt"
);
fixture_test!(
    stmt_namespace_outsidestmt_1,
    "corpus/stmt/namespace/outsideStmt_1.phpt"
);
fixture_test!(
    stmt_namespace_outsidestmt_2,
    "corpus/stmt/namespace/outsideStmt_2.phpt"
);
fixture_test!(
    stmt_namespace_outsidestmtinvalid_1,
    "corpus/stmt/namespace/outsideStmtInvalid_1.phpt"
);
fixture_test!(
    stmt_namespace_outsidestmtinvalid_2,
    "corpus/stmt/namespace/outsideStmtInvalid_2.phpt"
);
fixture_test!(
    stmt_namespace_outsidestmtinvalid_3,
    "corpus/stmt/namespace/outsideStmtInvalid_3.phpt"
);
fixture_test!(stmt_newininitializer, "corpus/stmt/newInInitializer.phpt");
fixture_test!(stmt_switch, "corpus/stmt/switch.phpt");
fixture_test!(stmt_trycatch, "corpus/stmt/tryCatch.phpt");
fixture_test!(
    stmt_trycatch_without_variable,
    "corpus/stmt/tryCatch_without_variable.phpt"
);
fixture_test!(
    stmt_trywithoutcatch,
    "corpus/stmt/tryWithoutCatch.phpt",
    errors
);
fixture_test!(stmt_unset, "corpus/stmt/unset.phpt");
fixture_test!(stmt_voidcast, "corpus/stmt/voidCast.phpt");
